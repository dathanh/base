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

class CreateDatabaseCommand extends Command {

    use CommandService;

    protected function buildOptionParser(ConsoleOptionParser $parser) {
        $parser->addArgument('name', [
            'help' => 'Name specific of Database'
        ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io) {
        $pathMigrate = CONFIG . 'Migrations/Test/';
        $listController = $this->getListConfig($args);
        if (!empty($listController)) {
            foreach ($listController as $name => $option) {
                $parseConfig = $this->parseFromConfig($option, $name);
                $filename = $pathMigrate . date('Ymdhi') . mt_rand(10, 99) . "_Create$name" . '.php';
                $parseConfig['data'] = $parseConfig['submitField'];

                $this->createTemplate($parseConfig, 'database', $filename);

                $io->out("Creare $name  Done");

                // create db tránlate
                if (!empty($parseConfig ['multiLangField'])) {

                    $filename = $pathMigrate . date('Ymdhi') . mt_rand(10, 99) . "_Create" . $parseConfig ['singleName'] . 'Translates.php';
                    $parseConfig['data'] = $parseConfig['multiLangField'];
                    $parseConfig['underPName'] = $parseConfig['underSName'] . '_translates';

                    $this->createTemplate($parseConfig, 'database', $filename);
                    $io->out("Create " . $parseConfig ['singleName'] . 'Translate Done');
                }
            }
            $io->out('Done');
            $shell = new ShellDispatcher();
            $output = $shell->run(['cake', 'migrations ', 'migrate']);
        } else {
            $io->out('Cannot found Config');
        }
    }

}
