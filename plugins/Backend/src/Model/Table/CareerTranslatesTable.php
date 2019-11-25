<?php

namespace Backend\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\Event\Event;
use Backend\Model\Entity\Career;
use Sluggable\Utility\Slug;

/**
 * CareerTranslates Model
 *
 */
class CareerTranslatesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('career_translates');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Careers', [
            'foreignKey' => 'career_id',
            'className' => 'Backend.Careers'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
        $validator->requirePresence('career_id', 'create')
                ->notEmpty('career_id', 'create');
        $validator->requirePresence('name', 'create')
                ->notEmpty('name', '', 'create');
//        $validator->requirePresence('overview', 'create')
//                ->notEmpty('overview', '', 'create');
        $validator->requirePresence('location', 'create')
                ->notEmpty('location', '', 'create');
//        $validator->requirePresence('responsibility', 'create')
//                ->notEmpty('responsibility', '', 'create');
        $validator->requirePresence('language_code', 'create')
                ->notEmpty('language_code', 'create');

        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
        if (isset($data['career_id']) && empty($data['career_id'])) {
            unset($data['career_id']);
        }
        if (isset($data['name']) && empty($data['name'])) {
            unset($data['name']);
        }
        if (isset($data['language_code']) && empty($data['language_code'])) {
            unset($data['language_code']);
        }
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['career_id'], 'Careers'));

        return $rules;
    }

}
