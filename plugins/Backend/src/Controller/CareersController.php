<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Backend\Utility\Utils;
use Cake\Core\Configure;

class CareersController extends BackendController {

    public $indexConfig = [
        'contains' => 'CareerTranslates',
        'limit' => 30,
        'finder' => 'careerByTitle',
        'fields' => [
            'name' => [
                'label' => 'Name',
                'format' => 'lang["vi"]["name"]',
            ],
            'status' => [
                'label' => 'Status',
            ],
        ]
    ];
    protected $fieldsSubmit = [
        'status' => [
            'label' => 'Status',
            'type' => 'checkbox',
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
