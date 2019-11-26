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
                'test' => [
                    'label' => 'TEst',
                    'type' => 'text',
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'thumbnail' => [
                    'label' => 'Thumbnail',
                    'type' => 'image',
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
            'contains' => 'ContactTranslates',
            'limit' => 30,
            'finder' => 'careerByTitle',
            'fields' => [
                'status' => [
                    'label' => 'Active',
                    'type' => 'checkbox',
                    'require' => false,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'thumbnail' => [
                    'label' => 'Thumbnail',
                    'type' => 'image',
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'banner' => [
                    'label' => 'Banner',
                    'type' => 'image',
                    'isIndex' => false,
                    'isView' => true,
                    'isMultiLang' => true,
                    'format' => ''
                ],
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'email' => [
                    'label' => 'Email',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'note' => [
                    'label' => 'Note',
                    'type' => 'text',
                    'require' => false,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
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
                'info' => [
                    'label' => 'Infomation',
                    'type' => 'text',
                    'require' => false,
                    'isIndex' => true,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'name' => [
                    'label' => 'Name',
                    'type' => 'text',
                    'require' => true,
                    'isIndex' => false,
                    'isView' => true,
                    'isMultiLang' => false,
                    'format' => ''
                ],
                'thumbnail' => [
                    'label' => 'Thumbnail',
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
