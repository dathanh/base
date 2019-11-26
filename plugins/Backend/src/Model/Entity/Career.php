<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Backend\Base\Entity\EntityTranslate;
use Cake\Core\Configure;

class Career extends EntityTranslate {

    public $multiLangField = [
                               'name',
                                           'location',
                                           'overview',
                                           'responsibility',
                        ];
    
        protected $_virtual = [
                    'linkThumbnail',
            ];
        
        
                    protected function _getLinkThumbnail() {
            return Configure::read('LinkStatic.UploadFolder') . 'Careers/' . $this->thumbnail;
        }
            
}
