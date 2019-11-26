<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Backend\Utility\Utils;
use Cake\Core\Configure;

class CareersController extends BackendController {
        use \Backend\Base\BaseService;
        public $indexConfig = [
        'contains' => 'CareerTranslates',
        'limit' => 30,
        'finder' => 'careerByString',
        'fields' => [
                        'name' => [
                        'label' => 'Name',
                                            'format' => 'lang["vi"]["name"]',
                                                                            ],
                        'status' => [
                        'label' => 'Status',
                                                                'render' => 'switch',
                                                        ],
                        'test' => [
                        'label' => 'TEst',
                                                                            ],
                        'thumbnail' => [
                        'label' => 'Thumbnail',
                                                                                    'render' => 'image',
                                    ],
                    ]
    ];
        protected $fieldsSubmit = [
                    'status' => [
                    'label' => 'Status',
                    'type' => 'checkbox',
                                                        ],
                    'test' => [
                    'label' => 'TEst',
                    'type' => 'text',
                                                        ],
                    'thumbnail' => [
                    'label' => 'Thumbnail',
                    'type' => 'image',
                                                                'format' => 'linkThumbnail',
                                    ],
            ];
            protected $multiLangFieldSubmit = [
                    'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                                            'require' => 'true',
                                                        ],
                    'location' => [
                    'label' => 'Location',
                    'type' => 'editor',
                                            'require' => 'true',
                                                        ],
                    'overview' => [
                    'label' => 'Overview',
                    'type' => 'editor',
                                                        ],
                    'responsibility' => [
                    'label' => 'Responsibilities',
                    'type' => 'editor',
                                                        ],
            ];
         
        protected function prepareObject($id) {
        $entityModel = $this->Careers->get($id, [
            'contain' => [
                'CareerTranslates'
            ]
        ]);
        return $entityModel;
    }
    
}
