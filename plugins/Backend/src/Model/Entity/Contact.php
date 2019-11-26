<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Backend\Base\Entity\EntityTranslate;
use Cake\Core\Configure;

class Contact extends EntityTranslate {

    public $multiLangField = [
        'banner'
    ];
    public $imageMultiLangField = [
        'banner'
    ];
    public $_virtual = [
        'linkThumbnail',
    ];

    protected function _getLinkThumbnail() {
        return Configure::read('LinkStatic.UploadFolder') . 'Contacts/' . $this->thumbnail;
    }

}
