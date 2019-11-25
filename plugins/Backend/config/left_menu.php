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
    ]
];
