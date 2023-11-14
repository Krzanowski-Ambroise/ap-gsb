<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Sheets Model
 *
 * @property \CakeDC\Users\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\StatesTable&\Cake\ORM\Association\BelongsTo $States
 * @property \App\Model\Table\OutpackagesTable&\Cake\ORM\Association\BelongsToMany $Outpackages
 * @property \App\Model\Table\PackagesTable&\Cake\ORM\Association\BelongsToMany $Packages
 *
 * @method \App\Model\Entity\Sheet newEmptyEntity()
 * @method \App\Model\Entity\Sheet newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Sheet[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Sheet get($primaryKey, $options = [])
 * @method \App\Model\Entity\Sheet findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Sheet patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Sheet[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Sheet|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sheet saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Sheet[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sheet[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sheet[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Sheet[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SheetsTable extends Table
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

        $this->setTable('sheets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'CakeDC/Users.Users',
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsToMany('Outpackages', [
            'foreignKey' => 'sheet_id',
            'targetForeignKey' => 'outpackage_id',
            'joinTable' => 'sheets_outpackages',
        ]);
        $this->belongsToMany('Packages', [
            'foreignKey' => 'sheet_id',
            'targetForeignKey' => 'package_id',
            'joinTable' => 'sheets_packages',
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
            ->uuid('user_id')
            ->allowEmptyString('user_id');

        $validator
            ->integer('state_id')
            ->notEmptyString('state_id');

        $validator
            ->boolean('sheetvalidated')
            ->requirePresence('sheetvalidated', 'create')
            ->notEmptyString('sheetvalidated');

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
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);
        $rules->add($rules->existsIn('state_id', 'States'), ['errorField' => 'state_id']);

        return $rules;
    }
}
