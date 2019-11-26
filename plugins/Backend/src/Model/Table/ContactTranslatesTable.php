<?php

namespace Backend\Model\Table;

use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Validation\Validation;
use Cake\Event\Event;
use Backend\Model\Entity\Contact;
use Sluggable\Utility\Slug;
use Backend\Utility\Utils;

class ContactTranslatesTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('contact_translates');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->belongsTo('Contacts', [
            'foreignKey' => 'contact_id',
            'className' => 'Backend.Contacts'
        ]);
    }

    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
        if (isset($data['banner']) && empty($data['banner'])) {
            unset($data['banner']);
        }
    }

    public function findContactByString(Query $query, array $options) {
        if (empty($options['title'])) {
            return $query;
        }
        $title = $options['title'];
        Utils::useTables($this, ['Backend.ContactTranslates']);
        $contactTranslate = $this->ContactTranslates->find('list', [
                    'conditions' => [
                        'OR' => [
                        ]
                    ],
                    'keyField' => 'id',
                    'valueField' => 'contact_id'
                ])->toArray();
        if (!empty($contactTranslate)) {
            $contactTranslate = array_unique($contactTranslate);
            return $query->where(['ContactTranslates.id IN' => $contactTranslate]);
        } else {
            return $query->where(['ContactTranslates.id' => 0]);
        }
    }

}
