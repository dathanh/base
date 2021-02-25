<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Backend\Utility\Utils;
use Cake\Core\Configure;

class ContactsController extends BackendController {
        use \Backend\Base\BaseService;
        public $indexConfig = [
        'contains' => 'ContactTranslates',
        'limit' => 30,
        'finder' => 'contactByString',
        'fields' => [
                        'status' => [
                        'label' => 'Active',
                                                                'render' => 'switch',
                                                        ],
                        'thumbnail' => [
                        'label' => 'Thumbnail',
                                                                                    'render' => 'image',
                                    ],
                        'name' => [
                        'label' => 'Name',
                                                                            ],
                        'email' => [
                        'label' => 'Email',
                                                                            ],
                        'note' => [
                        'label' => 'Note',
                                                                            ],
                    ]
    ];
        protected $fieldsSubmit = [
                    'status' => [
                    'label' => 'Active',
                    'type' => 'checkbox',
                                                        ],
                    'thumbnail' => [
                    'label' => 'Thumbnail',
                    'type' => 'image',
                                                                'format' => 'linkThumbnail',
                                    ],
                    'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                                            'require' => 'true',
                                                        ],
                    'email' => [
                    'label' => 'Email',
                    'type' => 'text',
                                            'require' => 'true',
                                                        ],
                    'note' => [
                    'label' => 'Note',
                    'type' => 'text',
                                                        ],
            ];
            protected $multiLangFieldSubmit = [
                    'banner' => [
                    'label' => 'Banner',
                    'type' => 'image',
                                                                'format' => 'linkBanner',
                                    ],
            ];
         
        protected function prepareObject($id) {
        $entityModel = $this->Contacts->get($id, [
            'contain' => [
                'ContactTranslates'
            ]
        ]);
        return $entityModel;
    }
    
}
