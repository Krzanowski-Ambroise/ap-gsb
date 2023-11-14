<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SheetsPackages Model
 *
 * @property \App\Model\Table\SheetsTable&\Cake\ORM\Association\BelongsTo $Sheets
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsTo $Packages
 *
 * @method \App\Model\Entity\SheetsPackage newEmptyEntity()
 * @method \App\Model\Entity\SheetsPackage newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\SheetsPackage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SheetsPackage get($primaryKey, $options = [])
 * @method \App\Model\Entity\SheetsPackage findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\SheetsPackage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SheetsPackage[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SheetsPackage|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SheetsPackage saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SheetsPackage[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SheetsPackage[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\SheetsPackage[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\SheetsPackage[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class SheetsPackagesTable extends Table
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

        $this->setTable('sheets_packages');

        $this->belongsTo('Sheets', [
            'foreignKey' => 'sheet_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Packages', [
            'foreignKey' => 'package_id',
            'joinType' => 'INNER',
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
            ->integer('sheet_id')
            ->notEmptyString('sheet_id');

        $validator
            ->integer('package_id')
            ->notEmptyString('package_id');

        $validator
            ->integer('quantity')
            ->notEmptyString('quantity');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('sheet_id', 'Sheets'), ['errorField' => 'sheet_id']);
        $rules->add($rules->existsIn('package_id', 'Packages'), ['errorField' => 'package_id']);

        return $rules;
    }
}
