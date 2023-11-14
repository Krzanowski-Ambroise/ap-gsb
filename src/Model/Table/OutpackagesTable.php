<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Outpackages Model
 *
 * @property \App\Model\Table\SheetsTable&\Cake\ORM\Association\BelongsToMany $Sheets
 *
 * @method \App\Model\Entity\Outpackage newEmptyEntity()
 * @method \App\Model\Entity\Outpackage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Outpackage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Outpackage get($primaryKey, $options = [])
 * @method \App\Model\Entity\Outpackage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Outpackage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Outpackage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Outpackage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Outpackage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Outpackage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Outpackage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Outpackage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Outpackage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class OutpackagesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('outpackages');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Sheets', [
            'foreignKey' => 'outpackage_id',
            'targetForeignKey' => 'sheet_id',
            'joinTable' => 'sheets_outpackages',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->notEmptyDate('date');

        $validator
            ->numeric('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->scalar('title')
            ->maxLength('title', 250)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('body')
            ->requirePresence('body', 'create')
            ->notEmptyString('body');

        return $validator;
    }
}
