<?php

namespace Backend\Controller;

use Backend\Base\BackendController;
use Cake\Core\Configure;

/**
 * AdminDashboard Controller
 */
class AdminDashboardController extends BackendController {

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index() {
        $listMenuCanShow = $this->Session->read('Backend.Menu');
        $menu = Configure::read('LeftMenu');
        $title = Configure::read('Title');

        $this->set(compact('menu', 'title','listMenuCanShow'));
    }

}
