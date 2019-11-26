<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Backend\Utility\Utils;
use Cake\Core\Configure;

class FeedbacksController extends BackendController {

    use \Backend\Base\BaseService;

    public $indexConfig = [
        'contains' => '',
        'limit' => 30,
        'finder' => 'feedbackByTitle',
        'fields' => [
            'status' => [
                'label' => 'Active',
                'render' => 'switch',
            ],
            'info' => [
                'label' => 'Infomation',
            ],
        ]
    ];
    protected $fieldsSubmit = [
        'status' => [
            'label' => 'Active',
            'type' => 'checkbox',
            'require' => 'true',
        ],
        'info' => [
            'label' => 'Infomation',
            'type' => 'text',
        ],
        'name' => [
            'label' => 'Name',
            'type' => 'text',
            'require' => 'true',
        ],
        'thumbnail' => [
            'label' => 'Thumbnail',
            'type' => 'image',
            'require' => 'true',
            'format' => 'linkThumbnail',
        ],
    ];

}
