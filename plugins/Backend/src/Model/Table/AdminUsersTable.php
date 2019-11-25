<?php
namespace Backend\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $AdminRoles
 */
class AdminUsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config
     *            The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('admin_users');
        $this->setDisplayField('email');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('AdminRoles', [
            'foreignKey' => 'admin_role_id',
            'className' => 'Backend.AdminRoles'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator
     *            Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->integer('id')->allowEmpty('id', 'create');

        $validator->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator->requirePresence('password', 'create')->notEmpty('password');
        $validator->allowEmpty('password', 'update');

        $validator->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator->dateTime('last_login')->allowEmpty('last_login');

        $validator->boolean('locked')->allowEmpty('locked');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules
     *            The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique([
            'email'
        ]));
        $rules->add($rules->existsIn([
            'admin_role_id'
        ], 'AdminRoles'));
        return $rules;
    }

    public function findByEmailAndRole(Query $query, array $options)
    {
        if (empty($options['title']) && empty($options['admin_role_id'])) {
            return;
        }

        if (!empty($options['title'])) {
            $query->where(['LOWER(AdminUsers.email) LIKE ' => '%' . mb_strtolower($options['title'], 'UTF-8') . '%']);
        }

//        if (!empty($options['admin_role_id'])) {
//            $query->where(['AdminUsers.admin_role_id' => $options['admin_role_id']]);
//        }
        return $query;
    }
}
