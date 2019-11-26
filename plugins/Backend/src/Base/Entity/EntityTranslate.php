<?php

namespace Backend\Base\Entity;

use Cake\ORM\Entity;
use stdClass;
use Cake\Core\Configure;
use Cake\Utility\Inflector;

class EntityTranslate extends Entity {

    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
    protected $_virtual = ['lang'];
    protected $multiLangField = [];
    protected $imageMultiLangField = [];

    public function __construct(array $properties = array(), array $options = array()) {
        parent::__construct($properties, $options);
        $this->setVirtual(['lang'], true);
    }

    protected function _getLang() {
        $parseClass = explode("\\", static::class);
        $curClass = $parseClass[sizeof($parseClass) - 1];

        $languageField = [];
        $tableTranslate = Inflector::underscore($curClass) . '_translates';
        $listLanguage = Configure::read('LanguageList');
        if (!empty($this->$tableTranslate) && !empty($this->multiLangField)) {
            foreach ($this->$tableTranslate as $objectTranslate) {
                foreach ($this->multiLangField as $field) {
                    $languageField[$objectTranslate->language_code][$field] = $objectTranslate->$field;
                    if (in_array($field, $this->imageMultiLangField)) {
                        $languageField[$objectTranslate->language_code]['link' . Inflector::camelize($field)] = Configure::read('LinkStatic.UploadFolder') . Inflector::pluralize($curClass) . '/' . $objectTranslate->$field;
                    }
                }
            }
            return $languageField;
        } else {
            foreach ($listLanguage as $langCode => $langName) {
                if (!empty($this->$langCode)) {
                    $languageField[$langCode] = $this->$langCode;
                }
            }
            return $languageField;
        }
    }

}
