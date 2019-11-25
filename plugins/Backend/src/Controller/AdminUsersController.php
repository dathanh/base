<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Cake\Event\Event;
use Backend\Utility\Utils;
use Cake\Core\Configure;

/**
 * AdminUsers Controller
 *
 * @property \Backend\Model\Table\AdminUsersTable $AdminUsers
 */
class AdminUsersController extends BackendController {

    use \Backend\Base\BaseService;

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout']);
    }

    public $tableName = 'AdminUsers';

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public $indexConfig = [
        'customAction' => 'AdminUser',
        'contains' => 'AdminRoles',
        'limit' => 30,
        'finder' => 'byEmailAndRole',
        'fields' => [
            'email' => [
                'label' => 'Email',
                'format' => 'emailFormat',
            ],
            'admin_role_id' => [
                'label' => 'Role',
                'format' => 'roleFormat',
            ],
            'active' => [
                'label' => 'Active',
                'render' => 'switch',
            ],
            'locked' => [
                'label' => 'Locked',
                'render' => 'active',
            ],
            'last_login' => [
                'label' => 'Last Login',
            ]
        ]
    ];
    protected $unsetView = [
        'password',
        'confirm_password',
    ];
    protected $fieldsSubmit = [
        'admin_role_id' => [
            'label' => 'Role',
            'type' => 'select',
            'format' => 'roleFormat',
        ],
        'first_name' => [
            'label' => 'First Name',
            'type' => 'text',
        ],
        'last_name' => [
            'label' => 'Last Name',
            'type' => 'text',
        ],
        'email' => [
            'label' => 'Email',
            'type' => 'text',
            'format' => 'emailFormat',
        ],
        'password' => [
            'label' => 'Password',
            'type' => 'password',
        ],
        'confirm_password' => [
            'label' => 'Confirm Password',
            'type' => 'password',
        ],
        'active' => [
            'label' => 'Active',
            'type' => 'checkbox',
        ],
        'locked' => [
            'label' => 'Locked',
            'type' => 'checkbox',
        ],
    ];

    protected function prepareFieldsSubmit($fieldsSubmit) {
        Utils::useTables($this, ['Backend.AdminRoles']);
        $optionAdminRole = $this->AdminRoles->find('list', [
                    'keyField' => 'id',
                    'valueField' => 'name'
                ])->toArray();
        $fieldsSubmit['admin_role_id']['custom'] = $optionAdminRole;

        return $fieldsSubmit;
    }

    protected function prepareDataSubmit($data) {
        if (!empty($data['password']) && $data['password'] != $data['confirm_password']) {
            $this->errorsData['confirm_password'] = [__('The password confirm does not match with password.')];
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
            $this->isSave = false;
        }
        return $data;
    }

    protected function prepareObject($id) {
        $entityModel = $this->AdminUsers->get($id, [
            'contain' => [
                'AdminRoles'
            ]
        ]);
        return $entityModel;
    }

    /**
     * - Lock account if user login failed 5 time
     * - Auto unlock after 15 minutes
     *
     * @return \Cake\Network\Response|null
     * @throws \Cake\ORM\Exception\MissingTableException
     */
    public function login() {
        $user = $this->Auth->user('id');
        if (!empty($user)) {
            return $this->redirect('/backend/admin-dashboard');
        }

        if ($this->request->is('post')) {
            Utils::useTables($this, ['Backend.AdminUsers', 'Backend.AdminRoles']);
            $countRole = $this->AdminRoles->find('all')->count();
            if ($countRole == 0) {
                $userRole = $this->AdminRoles->newEntity();
                $userRole = $this->AdminRoles->patchEntity($userRole, [
                    'id' => 1,
                    'name' => ROLE_SUPER_ADMIN,
                    'role' => 1,
                ]);
                $this->AdminRoles->save($userRole);
            }
            $countAccount = $this->AdminUsers->find('all')->count();
            if ($countAccount == 0) {
                $userAccount = $this->AdminUsers->newEntity();
                $userAccount = $this->AdminUsers->patchEntity($userAccount, [
                    'email' => $this->request->getData(['email']),
                    'admin_role_id' => 1,
                    'active' => true,
                    'locked' => false,
                ]);
                $userAccount->password = $this->request->getData(['password']);
                $this->AdminUsers->save($userAccount, ['checkRules' => false]);
            }
            $checkAccount = $this->AdminUsers->find('all', [
                        'conditions' => ['AdminUsers.email' => $this->request->getData(['email'])]
                    ])->first();

            if (!empty($checkAccount)) {

                $currentData = $this->AdminUsers->findById($checkAccount['id'])->first();
                $lastLogin = date('Y-m-d H:i:s');

                if ($checkAccount['locked'] == LOCKED) {

                    $timeSpan = (strtotime($lastLogin) - strtotime($checkAccount['last_login'])) / 60;

                    // instead of define a constant of Time Span Lock - we should pull this value from Configuations Table
                    if ($timeSpan < LOCK_TIME_SPAN) {
                        $this->Flash->error(__('Login has been temporarily disabled due to too many unsuccessful login attempts. Please try again after 15 minutes.'));
                        return;
                    }
                }
                // Update last_login
                $currentData->last_login = $lastLogin;
                $this->AdminUsers->save($currentData);

                if (!$checkAccount['active']) {
                    $this->Flash->error(__('You account has not been activated yet.'));
                    return;
                }

                $user = $this->Auth->identify();

                if ($user) {
                    $this->configMenu($user['admin_role_id']);
                    $this->Auth->setUser($user);

//                    $menuSetup
                    // Reset count_login and unlock
                    if (!empty($currentData)) {
                        $currentData->count_login = 0;
                        $currentData->locked = false;
                        $this->AdminUsers->save($currentData);
                    }
                    return $this->redirect('/backend/admin-dashboard');
                } else {
                    $currentData->count_login++;
                    if ($currentData->count_login == ATTEMPT_LOGIN_TIME) {
                        // Lock account
                        $currentData->locked = true;
                    }
                    $this->AdminUsers->save($currentData);
                }
            }
            $this->Flash->error(__('Invalid email or password. Please try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function configMenu($userId) {
        Utils::useTables($this, ['Backend.AdminRoles']);
        $curRole = $this->AdminRoles->find('all', [
                    'fields' => [
                        'role'
                    ],
                    'conditions' => [
                        'AdminRoles.id' => $userId,
                    ],
                ])->first();
        $curRoleFormat = json_decode($curRole->role, true);
        $curMenu = [];
        foreach ($curRoleFormat as $controller => $permission) {
            if ($permission['menu'] == Yes) {
                array_push($curMenu, $controller);
            }
        }
        $this->Session->write('Backend.Menu', $curMenu);
    }

}
