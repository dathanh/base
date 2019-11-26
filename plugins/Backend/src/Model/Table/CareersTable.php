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

class CareersTable extends Table {

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

    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
                                                                                                                
        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
                                    if (isset($data['status']) && empty($data['status'])) {
                         unset($data['status']);
                }
                            if (isset($data['test']) && empty($data['test'])) {
                         unset($data['test']);
                }
                            if (isset($data['thumbnail']) && empty($data['thumbnail'])) {
                         unset($data['thumbnail']);
                }
                        }
        public function findCareerByString(Query $query, array $options) {
        if (empty($options['title'])) {
            return $query;
        }
        $title = $options['title'];
        Utils::useTables($this, ['Backend.CareerTranslates']);
        $careerTranslate = $this->CareerTranslates->find('list', [
                    'conditions' => [
                        'OR' => [
                                                                                                                                        ['CareerTranslates.name LIKE' => '%' . $title . '%'],
                                                                                                                                                ['CareerTranslates.location LIKE' => '%' . $title . '%'],
                                                                                                                                                ['CareerTranslates.overview LIKE' => '%' . $title . '%'],
                                                                                                                                                ['CareerTranslates.responsibility LIKE' => '%' . $title . '%'],
                                                                                                                        ]
                    ],
                    'keyField' => 'id',
                    'valueField' => 'career_id'
                ])->toArray();
        if (!empty($careerTranslate)) {
            $careerTranslate = array_unique($careerTranslate);
            return $query->where(['Careers.id IN' => $careerTranslate]);
        } else {
            return $query->where(['Careers.id' => 0]);
        }
    }
    
}
