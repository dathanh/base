<?php

namespace Backend\Command;

use Cake\Console\Arguments;
use Bake\Shell\Task\BakeTemplateTask;
use Cake\Utility\Inflector;
use Cake\Core\Configure;

trait CommandService {

    public function parseFromConfig($option, $name) {
        $indexField = [];
        $submitField = [];
        $multiLangField = [];
        $imageField = [];
        $imageMultiLangField = [];
        $isUpload = false;
        foreach ($option['fields'] as $nameField => $optionField) {
            //create index field
            if (!empty($optionField['isIndex']) && $optionField['isIndex']) {
                $indexField[$nameField] = $optionField;
                unset($submitField[$nameField]['isIndex']);
                unset($submitField[$nameField]['isView']);
                unset($submitField[$nameField]['isMultiLang']);
            }
            //create submit field
            if (empty($optionField['isMultiLang']) || !$optionField['isMultiLang']) {
                $submitField[$nameField] = $optionField;
                unset($submitField[$nameField]['isIndex']);
                unset($submitField[$nameField]['isView']);
                unset($submitField[$nameField]['isMultiLang']);
                //create image field
                if (!empty($optionField) && $optionField['type'] == 'image') {
                    $isUpload = true;
                    $imageField[$nameField] = $submitField[$nameField];
                }
            }
            //create multi language field
            if (!empty($optionField) && $optionField['isMultiLang']) {
                $multiLangField[$nameField] = $optionField;
                unset($multiLangField[$nameField]['isIndex']);
                unset($multiLangField[$nameField]['isView']);
                unset($multiLangField[$nameField]['isMultiLang']);
                if (!empty($optionField) && $optionField['type'] == 'image') {
                    $isUpload = true;
                    $imageMultiLangField[$nameField] = $multiLangField[$nameField];
                }
            }
        }

        return [
            'limit' => $option['limit'],
            'contains' => $option['contains'],
            'finder' => $option['finder'],
            'indexField' => $indexField,
            'submitField' => $submitField,
            'multiLangField' => $multiLangField,
            'imageField' => $imageField,
            'isUpload' => $isUpload,
            'imageMultiLangField' => $imageMultiLangField,
            'isMultiLang' => !empty($multiLangField),
            'pluralName' => $name,
            'singleName' => Inflector::singularize($name),
            'underPName' => Inflector::underscore($name),
            'underSName' => Inflector::underscore(Inflector::singularize($name)),
        ];
    }

    public function createTemplate($data, $templateName, $filename) {
        $bakeTemplate = new BakeTemplateTask();
        $bakeTemplate->set($data);
        $contents = $bakeTemplate->generate("Backend.$templateName");
        $bakeTemplate->createFile($filename, $contents);
    }

    public function getListConfig(Arguments $args) {
        $controller = $args->getArgument('controller');

        if (!empty($controller)) {
            $camelNameMulti = Inflector::pluralize(Inflector::camelize($controller));
            $listController[$camelNameMulti] = Configure::read('Controller.' . $camelNameMulti);
        } else {
            $listController = Configure::read('Controller');
        }
        return $listController;
    }

}
