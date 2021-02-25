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

class CareerTranslatesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('career_translates');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
                           $this->belongsTo('Careers', [
                'foreignKey' => 'career_id',
                'className' => 'Backend.Careers'
            ]);
        
    }

    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
                                                    $validator ->requirePresence('name', 'create')
                                                        ->notEmpty('name','','create');
                                                            $validator ->requirePresence('location', 'create')
                                                        ->notEmpty('location','','create');
                                                                                            
        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
                                    if (isset($data['name']) && empty($data['name'])) {
                         unset($data['name']);
                }
                            if (isset($data['location']) && empty($data['location'])) {
                         unset($data['location']);
                }
                            if (isset($data['overview']) && empty($data['overview'])) {
                         unset($data['overview']);
                }
                            if (isset($data['responsibility']) && empty($data['responsibility'])) {
                         unset($data['responsibility']);
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
            return $query->where(['CareerTranslates.id IN' => $careerTranslate]);
        } else {
            return $query->where(['CareerTranslates.id' => 0]);
        }
    }
    
}
