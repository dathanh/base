<?php

namespace Backend\Model\Entity;

use Cake\ORM\Entity;

class Feedback extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];


}
