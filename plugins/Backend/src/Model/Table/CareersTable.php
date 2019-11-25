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
use Backend\Utility\Utils;

/**
 * Careers Model
 *
 */
class CareersTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('careers');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('CareerTranslates', [
            'foreignKey' => 'career_id',
            'className' => 'Backend.CareerTranslates'
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

        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
        
    }

    public function findCareerByTitle(Query $query, array $options) {
        if (empty($options['title'])) {
            return $query;
        }
        $title = $options['title'];
        Utils::useTables($this, ['Backend.CareerTranslates']);
        $careerTranslate = $this->CareerTranslates->find('list', [
                    'conditions' => [
                        'OR' => [
                            ['CareerTranslates.name LIKE' => '%' . $title . '%'],
                            ['CareerTranslates.location LIKE' => '%' . $title . '%']
                        ]
                    ],
                    'keyField' => 'id',
                    'valueField' => 'career_id'
                ])->toArray();
        if (!empty($careerTranslate)) {
            $careerTranslate = array_unique($careerTranslate);
            return $query->where(['Careers.id IN' => $careerTranslate]);
        } else {
            return $query->where(['Careers.id' => '#']);
        }
    }

}
