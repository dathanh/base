<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;

class ContactTranslate extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
    protected $_virtual = [
        'linkBanner',
    ];

    protected function _getLinkBanner() {
        return Configure::read('LinkStatic.UploadFolder') . 'Contacts/' . $this->banner;
    }

}
