<?php

namespace Backend\Base;

use Cake\Controller\Controller;
use Backend\Utility\Utils;
use Cake\Core\Configure;
use Cake\Utility\Inflector;
use Backend\Base\BaseController;
use Cake\Event\Event;
use Cake\Controller\Component\AuthComponent;

class BackendController extends BaseController {

    public $helpers = [
        'Paginator' => [
            'templates' => [
                'nextActive' => '<li class="paginate_button page-item next" id="sorting-table_next">
                                    <a href="{{url}}" class="page-link">{{text}}</a>
                                </li>',
                'nextDisabled' => '<li class="paginate_button page-item next disabled" id="sorting-table_next">
                                    <a href="{{url}}" class="page-link">{{text}}</a>
                                </li>',
                'prevActive' => '<li class="paginate_button page-item previous" id="sorting-table_previous">
                                    <a href="{{url}}" aria-controls="sorting-table" class="page-link">{{text}}</a>
                             </li>',
                'prevDisabled' => '<li class="paginate_button page-item previous disabled" id="sorting-table_previous">
                                    <a href="{{url}}" aria-controls="sorting-table" class="page-link">{{text}}</a>
                             </li>',
                'number' => '<li class="paginate_button page-item ">
                                    <a href="{{url}}"  class="page-link">{{text}}</a>
                         </li>',
                'current' => '<li class="paginate_button page-item active">
                                    <a href="{{url}}"  class="page-link">{{text}}</a>
                         </li>',
            ]
        ],
        'Form' => [
            'templates' => [
                'inputContainer' => '<div class="form-group row d-flex align-items-center mb-5">{{content}}</div>',
                'inputContainerError' => '<div class="form-group row d-flex align-items-center mb-5 has-error">{{content}}{{error}}</div>',
                'label' => '<label class="col-lg-4 form-control-label d-flex justify-content-lg-end" {{attrs}}>{{text}}</label>',
                'error' => '<div class="invalid-feedback">{{content}}</div>',
                'input' => ' <div class="col-lg-5"><input type="{{type}}"  class="form-control"  name="{{name}}" {{attrs}}/></div>',
            ]
        ]
    ];
    public $indexConfig = [
        'limit' => 50,
        'finder' => '',
        'contains' => [],
        'fields' => [
        ],
    ];
    private $inputUpload = ['image', 'video', 'file'];
    protected $tableName = '';
    protected $languageList = '';
    protected $indexContains = [];
    protected $fieldsIndex = [];
    protected $fieldsSubmit = [];
    protected $multiLangFieldSubmit = [];
    protected $unsetView = [];
    public $errorsData = [];
    protected $isSave = true;

    public function initialize() {
        parent::initialize();

        $parseClass = explode("\\", static::class);
        $curClass = $parseClass[sizeof($parseClass) - 1];
        $this->tableName = str_replace('Controller', '', $curClass);
        if (!empty($this->tableName)) {
            $tableObject = 'Backend.' . $this->tableName;
            Utils::useTables($this, [$tableObject]);
        }
        $title = Configure::read('Title');
        $this->languageList = Configure::read('LanguageList');
        $defaultLanguage = Configure::read('DefaultLanguageCode');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth');
        $this->viewBuilder()->setLayout('backend');

        $this->set(compact('title', 'defaultLanguage'));
        $this->set('listLanguage', $this->languageList);
        $this->set('tableName', $this->tableName);
        $this->set('curAcion', $this->request->getParam('action'));
        $this->set('curController', Inflector::humanize(Inflector::underscore($this->request->getParam('controller'))));
    }

    public function beforeFilter(Event $event) {
        $this->configureAuth();
        $this->Auth->allow(['login']);
    }

    public function index() {
        $finder = [];
        if (!empty($this->request->getQuery(['title']))) {
            if (!empty($this->indexConfig['finder'])) {
                $finder[$this->indexConfig['finder']] = [
                    'title' => $this->request->getQuery(['title'])
                ];
            }
        }
        $tableObject = $this->tableName;

        $this->paginate = [
            'limit' => $this->indexConfig['limit'],
            'contain' => $this->indexConfig['contains'],
            'order' => [
                "$tableObject.id" => 'desc',
            ],
            'finder' => $finder
        ];

        $listData = $this->paginate($this->$tableObject);

        $this->set('fieldsIndex', $this->indexConfig['fields']);
        $this->set('cutomHeader', !empty($this->indexConfig['cutomHeader']) ? $this->indexConfig['cutomHeader'] : '');
        $this->set('customAction', !empty($this->indexConfig['customAction']) ? 'CustomAction\\' . $this->indexConfig['customAction'] : '');
        $this->set(compact('listData'));
        $this->set('_serialize', ['listData']);

        $this->render('Backend.Crud/index');
    }

    protected function prepareDataSubmit($data) {
        return $data;
    }

    protected function prepareFieldsSubmit($fieldsSubmit) {
        return $fieldsSubmit;
    }

    public function add() {
        $tableObject = $this->tableName;
        $entityModel = $this->$tableObject->newEntity();
        $fieldsSubmit = $this->prepareFieldsSubmit($this->fieldsSubmit);
        $errors = [];
        $this->pushData($tableObject, $entityModel, $errors);

        $this->set('inputFields', $fieldsSubmit);
        $this->set('inputLangFields', $this->multiLangFieldSubmit);
        $this->set(compact('entityModel', 'errors'));
        $this->render('Backend.Crud/add');
    }

    public function pushData($tableObject, $entityModel, &$errors) {
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            $data = $this->prepareDataSubmit($data);


            $entityModel = $this->$tableObject->patchEntity($entityModel, $data);
            foreach ($this->fieldsSubmit as $field => $input) {
                if (!empty($input['type']) && ($input['type'] == 'checkbox')) {
                    $entityModel->$field = !empty($data[$field]) ? ACTIVE : INACTIVE;
                }
                if (!empty($input['type']) && ($input['type'] == 'multiple_image')) {
                    if (!empty($data[$field])) {
                        $fieldUploaded = 'gallery' . Inflector::camelize($field);
                        $entityModel->$field = json_encode($data[$field], true);
                        $entityModel->$fieldUploaded = !empty($data[$field]) ? json_encode($data[$field], true) : '[]';
                    }
                }
                if (!empty($input['type']) && ( in_array($input['type'], $this->inputUpload) )) {
                    $this->processUploadFile($field, $entityModel, $this->tableName . '/');
                }
            }
            if ($this->isSave) {
                if (!empty($this->multiLangFieldSubmit)) {
                    $isSaved = $this->$tableObject->getConnection()->transactional(function () use ($entityModel, $data, $tableObject) {
                        if ($this->$tableObject->save($entityModel)) {
                            if ($this->saveTranslateData($entityModel, $data)) {
                                return true;
                            } else {
                                return false;
                            }
                        } else {
                            return false;
                        }
                    });
                    if ($isSaved) {
                        $this->Flash->success(__('The career has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The career could not be saved. Please complete all the fields marked with (*) and try again.'));
                    }

                    $errors = array_merge($this->errorsData, $entityModel->getErrors());
                } else {
                    if ($this->$tableObject->save($entityModel)) {
                        $this->Flash->success(__('The ' . $this->tableName . ' has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('The ' . $this->tableName . ' could not be saved. Please complete all the fields marked with (*) and try again.'));
                    }
                }
            }
            $errors = array_merge($this->errorsData, $entityModel->getErrors());
        }
    }

    protected function prepareObject($id) {
        $tableObject = $this->tableName;
        $entityModel = $this->$tableObject->get($id);
        return $entityModel;
    }

    public function edit($id) {
        $tableObject = $this->tableName;
        $fieldsSubmit = $this->prepareFieldsSubmit($this->fieldsSubmit);
        $entityModel = $this->prepareObject($id);
        $errors = [];
        $this->pushData($tableObject, $entityModel, $errors);

        $this->set('inputFields', $fieldsSubmit);
        $this->set('inputLangFields', $this->multiLangFieldSubmit);
        $this->set(compact('entityModel', 'errors'));
        $this->render('Backend.Crud/add');
    }

    public function view($id = null) {
        $tableObject = $this->tableName;
        $entityModel = $this->prepareObject($id);
        $fieldsSubmit = $this->prepareFieldsSubmit($this->fieldsSubmit);
        if (!empty($this->unsetView)) {
            foreach ($this->unsetView as $field) {
                if (!empty($fieldsSubmit[$field])) {
                    unset($fieldsSubmit[$field]);
                }
            }
        }
        $this->set('inputLangFields', $this->multiLangFieldSubmit);
        $this->set('inputFields', $fieldsSubmit);
        $this->set(compact('entityModel'));
        $this->set('_serialize', ['entityModel']);
        $this->render('Backend.Crud/view');
    }

    public function delete($id = null) {
        $tableObject = $this->tableName;
        $this->request->allowMethod(['post', 'delete']);
        $entityModel = $this->$tableObject->findById($id)->first();
        if ($this->$tableObject->deleteAll(['id' => $id])) {
            $this->Flash->success(__('The  ' . $this->tableName . ' has been deleted.'));
        } else {
            $this->Flash->error(__('The  ' . $this->tableName . ' could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function changeStatus() {
        if ($this->request->is(['post'])) {
            $data = $this->request->getData();
            if (empty($data['id'])) {
                $this->sendJson(['message' => __('The  ' . $this->tableName . ' could not be activated. Please, try again.')], 500);
            } else {
                try {
                    $tableObject = $this->tableName;
                    $entityModel = $this->$tableObject->get($data['id']);
                    $value = $data['value'] == ACTIVE ? INACTIVE : ACTIVE;
                    $dataSubmit = [$data['type'] => $value];
                    $entityModel = $this->$tableObject->patchEntity($entityModel, $dataSubmit);
                    if ($this->$tableObject->save($entityModel)) {
                        $message = $value == ACTIVE ? __('activated') : __('inactivated');
                        $this->sendJson([
                            'message' => __('The  ' . $this->tableName . ' has been ') . $message,
                            'data' => $value,
                        ]);
                    } else {
                        $this->sendJson(['message' => __('The  ' . $this->tableName . ' could not be activated. Please, try again.')], 500);
                    }
                } catch (Exception $exception) {
                    throw new RequestException($exception->getMessage());
                }
            }
        }
    }

    public function saveTranslateData($object, $data = []) {
        $isSaved = true;
        if (empty($object->id) || empty($data)) {
            return false;
        }
        $tableNameTranslate = Inflector::singularize($this->tableName) . 'Translates';
        $tableNameUnderScore = Inflector::underscore(Inflector::singularize($this->tableName));
        $tableObject = $this->tableName;
        $dataLangOnly = [];
        $object->setAccess('lang', true);
        foreach ($this->languageList as $languageCode => $languageName) {
            $dataSave = $data[$languageCode];
            $dataSave[$tableNameUnderScore . '_id'] = $object->id;
            $dataSave['language_code'] = $languageCode;
            $dataLangOnly[$languageCode] = $data[$languageCode];

            $translateObject = $this->$tableObject->$tableNameTranslate;
            $translateData = $translateObject->find('all', [
                        'conditions' => [
                            $tableNameUnderScore . "_id" => $object->id,
                            'language_code' => $languageCode,
                        ]
                    ])->first();

            if (empty($translateData)) {
                $translateData = $translateObject->newEntity();
            }

            $objectTranslateSave = $translateObject->patchEntity($translateData, $dataSave);

            foreach ($this->multiLangFieldSubmit as $field => $input) {
                if (!empty($input['type']) && ($input['type'] == 'checkbox')) {
                    $objectTranslateSave->$field = !empty($dataSave[$field]) ? ACTIVE : INACTIVE;
                }
                if (!empty($input['type']) && ($input['type'] == 'multiple_image')) {
                    if (!empty($dataSave[$field])) {
                        $fieldUploaded = 'gallery' . Inflector::camelize($field);
                        $objectTranslateSave->$field = json_encode($dataSave[$field], true);
                        $objectTranslateSave->$fieldUploaded = !empty($dataSave[$field]) ? json_encode($dataSave[$field], true) : '[]';
                    }
                }
                if (!empty($input['type']) && ( in_array($input['type'], $this->inputUpload) )) {
                    $this->processUploadFile($field, $objectTranslateSave, $this->tableName . '/', $languageCode);
                }
            }


            if (!$translateObject->save($objectTranslateSave)) {
                $errors = $objectTranslateSave->getErrors();
                foreach ($errors as $fieldError => $value) {
                    $this->errorsData[$languageCode][$fieldError] = $value;
                }
                $isSaved = false;
            }
        }
        if (!$isSaved) {
            return false;
        }
        unset($objectTranslateSave);

        return true;
    }

    protected function configureAuth() {
        $this->Auth->setConfig('authorize', ['Controller']);
        $this->Auth->setConfig('loginRedirect', [
            'controller' => 'AdminDashboard',
            'action' => 'index'
        ]);
        $this->Auth->setConfig('loginAction', [
            'controller' => 'AdminUsers',
            'action' => 'login'
        ]);
        $this->Auth->setConfig('logoutRedirect', [
            'controller' => 'AdminUsers',
            'action' => 'login'
        ]);
        $this->Auth->setConfig('storage', 'Backend.BackendSession');
        $this->Auth->setConfig('authenticate', [
            AuthComponent::ALL => [
                'fields' => [
                    'username' => 'email',
                    'password' => 'password'
                ],
                'userModel' => 'Backend.AdminUsers'
            ],
            'Form' => [
                'passwordHasher' => [
                    'className' => 'Default'
                ]
            ]
        ]);
    }

    public function isAuthorized($user) {
        $controller = $this->request->getParam('controller');

        if ($controller === 'AdminDashboard' && !empty($this->Auth->user('id'))) {
            return true;
        }
        Utils::useTables($this, ['Backend.AdminRoles']);
        $curRole = $this->AdminRoles->find('all', [
                    'fields' => [
                        'role'
                    ],
                    'conditions' => [
                        'AdminRoles.id' => $user['admin_role_id'],
                    ],
                ])->first();
        $curRole = json_decode($curRole->role, true);

        $listController = array_keys($curRole);
        if (in_array($controller, $listController)) {
            $action = $this->request->getParam('action');
            if (in_array($action, ['index', 'view', 'delete', 'add', 'edit'])) {
                if (!empty($curRole[$controller][$action]) == Yes || $action == 'changeStatus') {
                    return true;
                } else {
                    $this->Flash->error(__('Permission denied!'));
                }
            } else {
                return true;
            }
        } else {
            $this->Flash->error(__('Permission denied!'));
        }

        return true;
    }

}
