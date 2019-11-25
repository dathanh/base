<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Backend\Utility\Utils;
use Cake\Core\Configure;

class ContactsController extends BackendController {

    public $tableName = 'Contacts';
    public $indexConfig = [
        'contains' => 'ContacxtTranslates',
        'limit' => 30,
        'finder' => 'careerByTitle',
        'fields' => [
                        'status' => [
                        'label' => 'Name',
                                    ],
                        'location' => [
                        'label' => 'location new',
                                    ],
                    ]
    ];
            protected $multiLangFieldSubmit = [
                    'status' => [
                    'label' => 'Name',
                    'type' => 'checkbox',
                                            'require' => 'true',
                                    ],
                    'location' => [
                    'label' => 'location new',
                    'type' => 'text',
                                            'require' => 'true',
                                    ],
            ];
         
        protected function prepareObject($id) {
        $entityModel = $this->Contacts->get($id, [
            'contain' => [
                'ContacxtTranslates'
            ]
        ]);
        return $entityModel;
    }
    
}
