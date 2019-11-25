<?php

namespace Backend\Base;

use Cake\Controller\Controller;
use Backend\Utility\Utils;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class BaseController extends Controller {

    const RESPONSE_CODE_NOT_FOUND = 404;
    const RESPONSE_CODE_UN_AUTHORIZATION = 401;
    const RESPONSE_CODE_BAD_REQUEST = 500;
    const RESPONSE_CODE_SUCCESS = 200;

    public static $_globalObjects = [
        'components' => [],
        'tables' => []
    ];
    public static $_instance = null;
    protected $Session = null;

    public function initialize() {
        parent::initialize();
        $this->Session = $this->request->getSession();
        self::$_instance = $this;
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
    }

    public function actionInvalid($message = 'Bad request!') {
        $this->sendJson(
                [
            'message' => $message,
            'data' => null
                ], self::RESPONSE_CODE_BAD_REQUEST
        );
    }

    public function actionNotFound($message = 'Data not found!') {
        $this->sendJson(
                [
            'message' => __($message),
            'data' => null
                ], self::RESPONSE_CODE_NOT_FOUND
        );
    }

    public function actionSuccess($response = [], $message = 'Successful') {
        $this->sendJson(
                [
            'success' => true,
            'message' => $message,
            'data' => $response
                ], self::RESPONSE_CODE_SUCCESS
        );
    }

    public function sendJson($json = null, $statusCode = 200) {
        $this->autoRender = false;
        $this->response->withType('json');
        $this->response = $this->response->withStatus($statusCode);
        $body = $this->response->getBody();
        $body->write(json_encode($json));
        $this->response->withBody($body);
    }

}
