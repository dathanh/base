<?php

namespace Backend\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;
use Cake\View\View;
use Backend\Utility\Utils;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class ContentHelper extends Helper {

    public function leftMenuBackend() {
        $listMenu = Configure::read('LeftMenu');
        $listMenuCanShow = $this->getView()->getRequest()->getSession()->read('Backend.Menu');
        $view = new \Cake\View\View();
        $view->setLayout(false);
        $view->set(compact('listMenu', 'listMenuCanShow'));
        $html = $view->render('Backend.Element/left_menu');
        return $html;
    }

    public function customFiledBackend($type, $value, $name) {
        $dirElement = 'Backend.Element/CustomIndex/';
        $view = new \Cake\View\View();
        $view->setLayout(false);
        $view->set(compact('value', 'name'));

        switch ($type) {
            case 'active':
                $html = $view->render($dirElement . 'active');
                break;
            case 'switch':
                $html = $view->render($dirElement . 'switch');
                break;
            default :
                $html = '';
                break;
        }


        return $html;
    }

}
