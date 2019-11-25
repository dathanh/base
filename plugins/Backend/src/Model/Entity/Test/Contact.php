<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Backend\Base\Entity\EntityTranslate;

class Contact extends EntityTranslate {

    public $multiLangField = [
        'location',
    ];

}
