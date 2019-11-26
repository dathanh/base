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

class ContactsTable extends Table {

    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('contacts');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->hasMany('ContactTranslates', [
            'foreignKey' => 'contact_id',
            'className' => 'Backend.ContactTranslates'
        ]);
    }

    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');
        $validator->requirePresence('name', 'create')
                ->notEmpty('name', '', 'create');
        $validator->requirePresence('email', 'create')
                ->notEmpty('email', '', 'create');

        return $validator;
    }

    public function beforeMarshal(Event $event, $data) {
        if (isset($data['status']) && empty($data['status'])) {
            unset($data['status']);
        }
        if (isset($data['thumbnail']) && empty($data['thumbnail'])) {
            unset($data['thumbnail']);
        }
        if (isset($data['name']) && empty($data['name'])) {
            unset($data['name']);
        }
        if (isset($data['email']) && empty($data['email'])) {
            unset($data['email']);
        }
        if (isset($data['note']) && empty($data['note'])) {
            unset($data['note']);
        }
    }

    public function findContactByTitle(Query $query, array $options) {
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
            return $query->where(['Contacts.id IN' => $contactTranslate]);
        } else {
            return $query->where(['Contacts.id' => '0']);
        }
    }

}
