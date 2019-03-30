<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Attachemnts Model
 *
 * @property \App\Model\Table\DepositsTable|\Cake\ORM\Association\BelongsTo $Deposits
 *
 * @method \App\Model\Entity\Attachemnt get($primaryKey, $options = [])
 * @method \App\Model\Entity\Attachemnt newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Attachemnt[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Attachemnt|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Attachemnt patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Attachemnt[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Attachemnt findOrCreate($search, callable $callback = null, $options = [])
 */
class AttachemntsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('attachemnts');
        $this->setDisplayField('ID');
        $this->setPrimaryKey('ID');

        $this->belongsTo('Deposits', [
            'foreignKey' => 'deposit_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('ID')
            ->allowEmpty('ID', 'create');

        $validator
            ->allowEmpty('url');

        $validator
            ->allowEmpty('comment');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['deposit_id'], 'Deposits'));

        return $rules;
    }
}
