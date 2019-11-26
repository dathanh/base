<?php

namespace Backend\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\Event\Event;
use Backend\Model\Entity\Feedback;
use Sluggable\Utility\Slug;
use Backend\Utility\Utils;

class FeedbacksTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('feedbacks');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
                
    }

    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
                                                    $validator ->requirePresence('status', 'create')
                                                        ->notEmpty('status','','create');
                                                                                        $validator ->requirePresence('name', 'create')
                                                        ->notEmpty('name','','create');
                                                            $validator ->requirePresence('thumbnail', 'create')
                                                        ->notEmpty('thumbnail','','create');
                                    
        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
                                    if (isset($data['status']) && empty($data['status'])) {
                         unset($data['status']);
                }
                            if (isset($data['info']) && empty($data['info'])) {
                         unset($data['info']);
                }
                            if (isset($data['name']) && empty($data['name'])) {
                         unset($data['name']);
                }
                            if (isset($data['thumbnail']) && empty($data['thumbnail'])) {
                         unset($data['thumbnail']);
                }
                        }
        public function findFeedbackByString(Query $query, array $options) {
        if (empty($options['title'])) {
            return $query;
        }
        $title = $options['title'];
        return $query->where(['OR' => [
                                                                                                                                   ['Feedbacks.info LIKE' => '%' . $title . '%'],
                                                                                               ['Feedbacks.name LIKE' => '%' . $title . '%'],
                                                                                                                ]]);
    }
    
}
