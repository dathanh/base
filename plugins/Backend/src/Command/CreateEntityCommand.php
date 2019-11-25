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

class CreateEntityCommand extends Command {

    use CommandService;

    protected function buildOptionParser(ConsoleOptionParser $parser) {
        $parser->addArgument('name', [
            'help' => 'Name specific of Database'
        ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io) {
        $dirFolder = Plugin::path('Backend') . 'src/Model/Entity/Test/';
        $listController = $this->getListConfig($args);
        if (!empty($listController)) {
            foreach ($listController as $name => $option) {
                $parseConfig = $this->parseFromConfig($option, $name);
                $parseConfig['data'] = $parseConfig['submitField'];
                $parseConfig['template'] = 'singleLang';

                $filename = $dirFolder . $parseConfig['singleName'] . '.php';

                $this->createTemplate($parseConfig, 'entity', $filename);

                $io->out("Create $name  Done");

                if (!empty($parseConfig ['multiLangField'])) {
                    $filename = $dirFolder . $parseConfig['singleName'] . 'Translate.php';
                    $parseConfig['data'] = $parseConfig['multiLangField'];
                    $parseConfig['singleName'] = $parseConfig['singleName'] . 'Translate';
                    $parseConfig['template'] = 'multiLang';

                    $this->createTemplate($parseConfig, 'entity', $filename);
                    $io->out("Create " . $parseConfig ['singleName'] . 'Translate Entity Done');
                }
            }
            $io->out('Done');
        } else {
            $io->out('Cannot found Config');
        }
    }

}
