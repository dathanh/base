<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;
use Cake\Core\Configure;
use Backend\Base\Entity\EntityTranslate;

class Career extends EntityTranslate {

    public $multiLangField = ['name', 'location', 'overview', 'responsibility'];

}
