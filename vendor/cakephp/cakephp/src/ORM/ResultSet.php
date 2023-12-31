<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\ORM;

use Cake\Collection\Collection;
use Cake\Collection\CollectionTrait;
use Cake\Database\Exception\DatabaseException;
use Cake\Database\StatementInterface;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use SplFixedArray;

/**
 * Represents the results obtained after executing a query for a specific table
 * This object is responsible for correctly nesting result keys reported from
 * the query, casting each field to the correct type and executing the extra
 * queries required for eager loading external associations.
 *
 * @template T of \Cake\Datasource\EntityInterface|array
 * @implements \Cake\Datasource\ResultSetInterface<T>
 */
class ResultSet implements ResultSetInterface
{
    use CollectionTrait;

    /**
     * Database statement holding the results
     *
     * @var \Cake\Database\StatementInterface
     */
    protected $_statement;

    /**
     * Points to the next record number that should be fetched
     *
     * @var int
     */
    protected $_index = 0;

    /**
     * Last record fetched from the statement
     *
     * @var \Cake\Datasource\EntityInterface|array
     * @psalm-var T
     */
    protected $_current;

    /**
     * Default table instance
     *
     * @var \Cake\ORM\Table
     */
    protected $_defaultTable;

    /**
     * The default table alias
     *
     * @var string
     */
    protected $_defaultAlias;

    /**
     * List of associations that should be placed under the `_matchingData`
     * result key.
     *
     * @var array<string, mixed>
     */
    protected $_matchingMap = [];

    /**
     * List of associations that should be eager loaded.
     *
     * @var array
     */
    protected $_containMap = [];

    /**
     * Map of fields that are fetched from the statement with
     * their type and the table they belong to
     *
     * @var array<string, mixed>
     */
    protected $_map = [];

    /**
     * List of matching associations and the column keys to expect
     * from each of them.
     *
     * @var array<string, mixed>
     */
    protected $_matchingMapColumns = [];

    /**
     * Results that have been fetched or hydrated into the results.
     *
     * @var \SplFixedArray|array
     */
    protected $_results = [];

    /**
     * Whether to hydrate results into objects or not
     *
     * @var bool
     */
    protected $_hydrate = true;

    /**
     * Tracks value of $_autoFields property of $query passed to constructor.
     *
     * @var bool|null
     */
    protected $_autoFields;

    /**
     * The fully namespaced name of the class to use for hydrating results
     *
     * @var string
     */
    protected $_entityClass;

    /**
     * Whether to buffer results fetched from the statement
     *
     * @var bool
     */
    protected $_useBuffering = true;

    /**
     * Holds the count of records in this result set
     *
     * @var int
     */
    protected $_count;

    /**
     * The Database driver object.
     *
     * Cached in a property to avoid multiple calls to the same function.
     *
     * @var \Cake\Database\DriverInterface
     */
    protected $_driver;

    /**
     * Constructor
     *
     * @param \Cake\ORM\Query $query Query from where results come
     * @param \Cake\Database\StatementInterface $statement The statement to fetch from
     */
    public function __construct(Query $query, StatementInterface $statement)
    {
        $repository = $query->getRepository();
        $this->_statement = $statement;
        $this->_driver = $query->getConnection()->getDriver($query->getConnectionRole());
        $this->_defaultTable = $repository;
        $this->_calculateAssociationMap($query);
        $this->_hydrate = $query->isHydrationEnabled();
        $this->_entityClass = $repository->getEntityClass();
        $this->_useBuffering = $query->isBufferedResultsEnabled();
        $this->_defaultAlias = $this->_defaultTable->getAlias();
        $this->_calculateColumnMap($query);
        $this->_autoFields = $query->isAutoFieldsEnabled();

        if ($this->_useBuffering) {
            $count = $this->count();
            $this->_results = new SplFixedArray($count);
        }
    }

    /**
     * Returns the current record in the result iterator
     *
     * Part of Iterator interface.
     *
     * @return \Cake\Datasource\EntityInterface|array
     * @psalm-return T
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->_current;
    }

    /**
     * Returns the key of the current record in the iterator
     *
     * Part of Iterator interface.
     *
     * @return int
     */
    public function key(): int
    {
        return $this->_index;
    }

    /**
     * Advances the iterator pointer to the next record
     *
     * Part of Iterator interface.
     *
     * @return void
     */
    public function next(): void
    {
        $this->_index++;
    }

    /**
     * Rewinds a ResultSet.
     *
     * Part of Iterator interface.
     *
     * @throws \Cake\Database\Exception\DatabaseException
     * @return void
     */
    public function rewind(): void
    {
        if ($this->_index === 0) {
            return;
        }

        if (!$this->_useBuffering) {
            $msg = 'You cannot rewind an un-buffered ResultSet. '
                . 'Use Query::bufferResults() to get a buffered ResultSet.';
            throw new DatabaseException($msg);
        }

        $this->_index = 0;
    }

    /**
     * Whether there are more results to be fetched from the iterator
     *
     * Part of Iterator interface.
     *
     * @return bool
     */
    public function valid(): bool
    {
        if ($this->_useBuffering) {
            $valid = $this->_index < $this->_count;
            if ($valid && $this->_results[$this->_index] !== null) {
                $this->_current = $this->_results[$this->_index];

                return true;
            }
            if (!$valid) {
                return $valid;
            }
        }

        $this->_current = $this->_fetchResult();
        $valid = $this->_current !== false;

        if ($valid && $this->_useBuffering) {
            $this->_results[$this->_index] = $this->_current;
        }
        if (!$valid && $this->_statement !== null) {
            $this->_statement->closeCursor();
        }

        return $valid;
    }

    /**
     * Get the first record from a result set.
     *
     * This method will also close the underlying statement cursor.
     *
     * @return \Cake\Datasource\EntityInterface|array|null
     * @psalm-return T|null
     */
    public function first()
    {
        foreach ($this as $result) {
            if ($this->_statement !== null && !$this->_useBuffering) {
                $this->_statement->closeCursor();
            }

            return $result;
        }

        return null;
    }

    /**
     * Serializes a resultset.
     *
     * Part of Serializable interface.
     *
     * @return string Serialized object
     */
    public function serialize(): string
    {
        return serialize($this->__serialize());
    }

    /**
     * Serializes a resultset.
     *
     * @return array
     */
    public function __serialize(): array
    {
        if (!$this->_useBuffering) {
            $msg = 'You cannot serialize an un-buffered ResultSet. '
                . 'Use Query::bufferResults() to get a buffered ResultSet.';
            throw new DatabaseException($msg);
        }

        while ($this->valid()) {
            $this->next();
        }

        if ($this->_results instanceof SplFixedArray) {
            return $this->_results->toArray();
        }

        return $this->_results;
    }

    /**
     * Unserializes a resultset.
     *
     * Part of Serializable interface.
     *
     * @param string $serialized Serialized object
     * @return void
     */
    public function unserialize($serialized)
    {
        $this->__unserialize((array)(unserialize($serialized) ?: []));
    }

    /**
     * Unserializes a resultset.
     *
     * @param array $data Data array.
     * @return void
     */
    public function __unserialize(array $data): void
    {
        $this->_results = SplFixedArray::fromArray($data);
        $this->_useBuffering = true;
        $this->_count = $this->_results->count();
    }

    /**
     * Gives the number of rows in the result set.
     *
     * Part of the Countable interface.
     *
     * @return int
     */
    public function count(): int
    {
        if ($this->_count !== null) {
            return $this->_count;
        }
        if ($this->_statement !== null) {
            return $this->_count = $this->_statement->rowCount();
        }

        if ($this->_results instanceof SplFixedArray) {
            $this->_count = $this->_results->count();
        } else {
            $this->_count = count($this->_results);
        }

        return $this->_count;
    }

    /**
     * Calculates the list of associations that should get eager loaded
     * when fetching each record
     *
     * @param \Cake\ORM\Query $query The query from where to derive the associations
     * @return void
     */
    protected function _calculateAssociationMap(Query $query): void
    {
        $map = $query->getEagerLoader()->associationsMap($this->_defaultTable);
        $this->_matchingMap = (new Collection($map))
            ->match(['matching' => true])
            ->indexBy('alias')
            ->toArray();

        $this->_containMap = (new Collection(array_reverse($map)))
            ->match(['matching' => false])
            ->indexBy('nestKey')
            ->toArray();
    }

    /**
     * Creates a map of row keys out of the query select clause that can be
     * used to hydrate nested result sets more quickly.
     *
     * @param \Cake\ORM\Query $query The query from where to derive the column map
     * @return void
     */
    protected function _calculateColumnMap(Query $query): void
    {
        $map = [];
        foreach ($query->clause('select') as $key => $field) {
            $key = trim($key, '"`[]');

            if (strpos($key, '__') <= 0) {
                $map[$this->_defaultAlias][$key] = $key;
                continue;
            }

            $parts = explode('__', $key, 2);
            $map[$parts[0]][$key] = $parts[1];
        }

        foreach ($this->_matchingMap as $alias => $assoc) {
            if (!isset($map[$alias])) {
                continue;
            }
            $this->_matchingMapColumns[$alias] = $map[$alias];
            unset($map[$alias]);
        }

        $this->_map = $map;
    }

    /**
     * Helper function to fetch the next result from the statement or
     * seeded results.
     *
     * @return mixed
     */
    protected function _fetchResult()
    {
        if ($this->_statement === null) {
            return false;
        }

        $row = $this->_statement->fetch('assoc');
        if ($row === false) {
            return $row;
        }

        return $this->_groupResult($row);
    }

    /**
     * Correctly nests results keys including those coming from associations
     *
     * @param array $row Array containing columns and values or false if there is no results
     * @return \Cake\Datasource\EntityInterface|array Results
     */
    protected function _groupResult(array $row)
    {
        $defaultAlias = $this->_defaultAlias;
        $results = $presentAliases = [];
        $options = [
            'useSetters' => false,
            'markClean' => true,
            'markNew' => false,
            'guard' => false,
        ];

        foreach ($this->_matchingMapColumns as $alias => $keys) {
            $matching = $this->_matchingMap[$alias];
            $results['_matchingData'][$alias] = array_combine(
                $keys,
                array_intersect_key($row, $keys)
            );
            if ($this->_hydrate) {
                /** @var \Cake\ORM\Table $table */
                $table = $matching['instance'];
                $options['source'] = $table->getRegistryAlias();
                /** @var \Cake\Datasource\EntityInterface $entity */
                $entity = new $matching['entityClass']($results['_matchingData'][$alias], $options);
                $results['_matchingData'][$alias] = $entity;
            }
        }

        foreach ($this->_map as $table => $keys) {
            $results[$table] = array_combine($keys, array_intersect_key($row, $keys));
            $presentAliases[$table] = true;
        }

        // If the default table is not in the results, set
        // it to an empty array so that any contained
        // associations hydrate correctly.
        $results[$defaultAlias] = $results[$defaultAlias] ?? [];

        unset($presentAliases[$defaultAlias]);

        foreach ($this->_containMap as $assoc) {
            $alias = $assoc['nestKey'];

            if ($assoc['canBeJoined'] && empty($this->_map[$alias])) {
                continue;
            }

            /** @var \Cake\ORM\Association $instance */
            $instance = $assoc['instance'];

            if (!$assoc['canBeJoined'] && !isset($row[$alias])) {
                $results = $instance->defaultRowValue($results, $assoc['canBeJoined']);
                continue;
            }

            if (!$assoc['canBeJoined']) {
                $results[$alias] = $row[$alias];
            }

            $target = $instance->getTarget();
            $options['source'] = $target->getRegistryAlias();
            unset($presentAliases[$alias]);

            if ($assoc['canBeJoined'] && $this->_autoFields !== false) {
                $hasData = false;
                foreach ($results[$alias] as $v) {
                    if ($v !== null && $v !== []) {
                        $hasData = true;
                        break;
                    }
                }

                if (!$hasData) {
                    $results[$alias] = null;
                }
            }

            if ($this->_hydrate && $results[$alias] !== null && $assoc['canBeJoined']) {
                $entity = new $assoc['entityClass']($results[$alias], $options);
                $results[$alias] = $entity;
            }

            $results = $instance->transformRow($results, $alias, $assoc['canBeJoined'], $assoc['targetProperty']);
        }

        foreach ($presentAliases as $alias => $present) {
            if (!isset($results[$alias])) {
                continue;
            }
            $results[$defaultAlias][$alias] = $results[$alias];
        }

        if (isset($results['_matchingData'])) {
            $results[$defaultAlias]['_matchingData'] = $results['_matchingData'];
        }

        $options['source'] = $this->_defaultTable->getRegistryAlias();
        if (isset($results[$defaultAlias])) {
            $results = $results[$defaultAlias];
        }
        if ($this->_hydrate && !($results instanceof EntityInterface)) {
            $results = new $this->_entityClass($results, $options);
        }

        return $results;
    }

    /**
     * Returns an array that can be used to describe the internal state of this
     * object.
     *
     * @return array<string, mixed>
     */
    public function __debugInfo()
    {
        $currentIndex = $this->_index;
        // toArray() adjusts the current index, so we have to reset it
        $items = $this->toArray();
        $this->_index = $currentIndex;

        return [
            'items' => $items,
        ];
    }
}
