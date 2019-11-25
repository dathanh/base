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
        foreach ($option['fields'] as $nameField => $optionField) {
            //create index field
            if (!empty($optionField['isIndex']) && $optionField['isIndex']) {
                $indexField[$nameField]['name'] = $nameField;
                $indexField[$nameField] = [
                    'label' => $optionField['label']
                ];
                if (!empty($optionField['format'])) {
                    $indexField[$nameField]['format'] = $optionField['format'];
                }
                if ($optionField['type'] == 'checkbox') {
                    $indexField[$nameField]['render'] = 'switch';
                }
            }
            //create submit field
            if (empty($optionField['isMultiLang']) || !$optionField['isMultiLang']) {
                $submitField[$nameField] = $optionField;
                unset($submitField[$nameField]['isIndex']);
                unset($submitField[$nameField]['isView']);
                unset($submitField[$nameField]['isMultiLang']);
            }
            //create multi languaue field
            if (!empty($optionField) && $optionField['isMultiLang']) {
                $multiLangField[$nameField] = $optionField;
                unset($multiLangField[$nameField]['isIndex']);
                unset($multiLangField[$nameField]['isView']);
                unset($multiLangField[$nameField]['isMultiLang']);
            }
        }

        return [
            'limit' => $option['limit'],
            'contains' => $option['contains'],
            'finder' => $option['finder'],
            'indexField' => $indexField,
            'submitField' => $submitField,
            'multiLangField' => $multiLangField,
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
