<?php

namespace Backend\Command;

use Cake\Console\Arguments;
use Cake\Console\Command;
use Cake\Console\ConsoleIo;
use Bake\Shell\Task\BakeTemplateTask;
use Cake\Core\Configure;
use Cake\Console\ConsoleOptionParser;
use Cake\Utility\Inflector;
use Cake\Core\Plugin;
use Cake\Console\ShellDispatcher;

class CreateTableCommand extends Command {

    use CommandService;

    protected function buildOptionParser(ConsoleOptionParser $parser) {
        $parser->addArgument('name', [
            'help' => 'Name specific of Database'
        ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io) {
        $dirFolder = Plugin::path('Backend') . 'src/Model/Table/';

        $listController = $this->getListConfig($args);
        if (!empty($listController)) {
            foreach ($listController as $name => $option) {
                $parseConfig = $this->parseFromConfig($option, $name);
                $parseConfig['data'] = $parseConfig['submitField'];
                $filename = $dirFolder . $name . 'Table.php';

                $this->createTemplate($parseConfig, 'table', $filename);

                $io->out("Creare $name  Done");

                if (!empty($parseConfig ['multiLangField'])) {
                    $filename = $dirFolder . $parseConfig['singleName'] . 'TranslatesTable.php';
                    $parseConfig['data'] = $parseConfig['multiLangField'];
                    $this->createTemplate($parseConfig, 'table', $filename);
                    $io->out("Creare " . $parseConfig ['singleName'] . 'TranslatesTable Done');
                }
            }
            $io->out('Done');
        } else {
            $io->out('Cannot found Config');
        }
    }

}
