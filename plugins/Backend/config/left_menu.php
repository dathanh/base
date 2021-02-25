<?php

return [
'LeftMenu' => [
        ['name' => 'Admin'
        ],
        [
            'name' => 'Admin User',
            'index' => 1,
            "controller" => "AdminUsers",
            'action' => 'index',
            'icon' => 'la la-users',
            'subMenu' => [
                [
                    'name' => 'List Admin Users',
                    "controller" => "AdminUsers",
                    'action' => 'index',
                ],
                [
                    'name' => 'Add Admin Users',
                    "controller" => "AdminUsers",
                    'action' => 'add',
                ]
            ],
        ],
        [
            'name' => 'Admin Roles',
            'index' => 2,
            "controller" => "AdminRoles",
            'action' => 'index',
            'icon' => 'la la-certificate',
            'subMenu' => [
                [
                    'name' => 'List Admin Roles',
                    "controller" => "AdminRoles",
                    'action' => 'index',
                ],
                [
                    'name' => 'Add Admin Roles',
                    "controller" => "AdminRoles",
                    'action' => 'add',
                ]
            ]
        ],
        ['name' => 'Page'
        ],
//-------------------------------Start--------------------------------------
                                     [
                    'name' => 'Careers',
                    'index' => 3,
                    "controller" => "Careers",
                    'action' => 'index',
                    'icon' => 'la la-plus',
                    'subMenu' => [
                        [
                            'name' => 'List Careers',
                            "controller" => "Careers",
                            'action' => 'index',
                        ],
                        [
                            'name' => 'Add Careers',
                            "controller" => "Careers",
                            'action' => 'add',
                        ]
                    ]
                ],
                             [
                    'name' => 'Contacts',
                    'index' => 3,
                    "controller" => "Contacts",
                    'action' => 'index',
                    'icon' => 'la la-plus',
                    'subMenu' => [
                        [
                            'name' => 'List Contacts',
                            "controller" => "Contacts",
                            'action' => 'index',
                        ],
                        [
                            'name' => 'Add Contacts',
                            "controller" => "Contacts",
                            'action' => 'add',
                        ]
                    ]
                ],
                             [
                    'name' => 'Feedbacks',
                    'index' => 3,
                    "controller" => "Feedbacks",
                    'action' => 'index',
                    'icon' => 'la la-plus',
                    'subMenu' => [
                        [
                            'name' => 'List Feedbacks',
                            "controller" => "Feedbacks",
                            'action' => 'index',
                        ],
                        [
                            'name' => 'Add Feedbacks',
                            "controller" => "Feedbacks",
                            'action' => 'add',
                        ]
                    ]
                ],
              
            ]
//-------------------------------End---------------------------------------    
];