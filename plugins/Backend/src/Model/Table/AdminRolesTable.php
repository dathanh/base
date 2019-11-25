<?php

namespace Backend\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AdminRoles Model
 *
 * @property \Cake\ORM\Association\HasMany $AdminUsers
 */
class AdminRolesTable extends Table
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
        $this->setTable('admin_roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('AdminUsers', [
            'foreignKey' => 'admin_role_id',
            'className' => 'Backend.AdminUsers'
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('role', 'create')
            ->notEmpty('role');

        return $validator;
    }

    public function findByName(Query $query, array $options)
    {
        if (empty($options['title'])) {
            return;
        }

        if (!empty($options['title'])) {
            $query->where(['LOWER(AdminRoles.name) LIKE' => '%' . mb_strtolower($options['title'], 'UTF-8') . '%']);
        }
        return $query;
    }

}
