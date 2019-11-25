<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Backend\Utility\Utils;
use Cake\Core\Configure;

class FeedbacksController extends BackendController {

    public $tableName = 'Feedbacks';
    public $indexConfig = [
        'contains' => '',
        'limit' => 30,
        'finder' => 'feedbackByTitle',
        'fields' => [
            'status' => [
                'label' => 'Active',
            ],
            'location' => [
                'label' => 'location new',
            ],
            'name' => [
                'label' => 'Name fb',
            ],
        ]
    ];
    protected $fieldsSubmit = [
        'status' => [
            'label' => 'Active',
            'type' => 'checkbox',
            'require' => 'true',
        ],
        'location' => [
            'label' => 'location new',
            'type' => 'text',
            'require' => 'true',
        ],
        'name' => [
            'label' => 'Name fb',
            'type' => 'text',
            'require' => 'true',
        ],
        'thumbnail' => [
            'label' => 'thumbnail new',
            'type' => 'image',
            'require' => 'true',
        ],
    ];

}
