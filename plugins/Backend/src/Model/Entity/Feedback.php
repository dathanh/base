<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class Feedback extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
        protected $_virtual = [
                   'linkThumbnail',
            ];
                        protected function _getLinkThumbnail() {
            return Configure::read('LinkStatic.UploadFolder') . 'Feedbacks/' . $this->thumbnail;
        }
                
  
}
