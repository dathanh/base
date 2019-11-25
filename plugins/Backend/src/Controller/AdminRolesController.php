<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Cake\Core\Configure;
use Backend\Utility\Utils;

/**
 * AdminRoles Controller
 *
 * @property \Backend\Model\Table\AdminRolesTable $AdminRoles
 */
class AdminRolesController extends BackendController {

    public $tableName = 'AdminRoles';

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public $indexConfig = [
        'limit' => 30,
        'finder' => 'byName',
        'contains' => [],
        'fields' => [
            'name' => [
                'label' => 'Name',
            ],
            'created' => [
                'label' => 'Create',
            ],
            'modified' => [
                'label' => 'Modified',
            ]
        ]
    ];
    protected $fieldsSubmit = [
        'name' => [
            'label' => 'Name',
            'type' => 'text',
        ],
        'role' => [
            'label' => 'Permission',
            'type' => 'permission',
            'render'=>'permission'
        ],
    ];

    public function prepareFieldsSubmit($fieldsSubmit) {
        $menu = Configure::read('LeftMenu');
        $fieldsSubmit['role']['custom'] = $menu;

        return $fieldsSubmit;
    }

    public function prepareDataSubmit($data) {
        $data['role'] = json_encode($data['role']);
        return $data;
    }

    protected function prepareObject($id) {
        Utils::useTables($this, ['Backend.AdminRoles']);
        $curRole = $this->AdminRoles->find('all', [
                    'conditions' => [
                        'id' => $id
                    ]
                ])->first();
        $curRole->role = json_decode($curRole->role, true);

        return $curRole;
    }

}
