<?php

return [
    'Controller' => [
        'Careers' => [
            'customHeader' => '',
            'customAction' => '',
            'contains' => 'CareerTranslates',
            'limit' => 30,
            'finder' => 'careerByTitle',
            'fields' => [
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => 'lang["vi"]["name"]',
                ],
                'status' => [
                    'label' => 'Status',
                    'type' => 'checkbox',
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'location' => [
                    'label' => 'Location',
                    'type' => 'editor',
                    'require' => true,
                    'isIndex' => false,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => 'lang["vi"]["location"]',
                ],
                'overview' => [
                    'label' => 'Overview',
                    'type' => 'editor',
                    'isIndex' => false,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => 'lang["vi"]["overview"]',
                ],
                'responsibility' => [
                    'label' => 'Responsibilities',
                    'type' => 'editor',
                    'isIndex' => false,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => 'lang["vi"]["responsibility"]',
                ],
            ]
        ],
        'Contacts' => [
            'customHeader' => '',
            'customAction' => '',
            'contains' => 'ContacxtTranslates',
            'limit' => 30,
            'finder' => 'careerByTitle',
            'fields' => [
                'status' => [
                    'label' => 'Name',
                    'type' => 'checkbox',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => ''
                ],
                'location' => [
                    'label' => 'location new',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => ''
                ],
            ]
        ],
        'Feedbacks' => [
            'customHeader' => '',
            'customAction' => '',
            'contains' => '',
            'limit' => 30,
            'finder' => 'feedbackByTitle',
            'fields' => [
                'status' => [
                    'label' => 'Active',
                    'type' => 'checkbox',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'location' => [
                    'label' => 'location new',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'name' => [
                    'label' => 'Name fb',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'thumbnail' => [
                    'label' => 'thumbnail new',
                    'type' => 'image',
                    'require' => true,
                    'isIndex' => false,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
            ]
        ],
    ]
];
