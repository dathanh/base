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

class CreateControllerCommand extends Command {

    use CommandService;

    protected function buildOptionParser(ConsoleOptionParser $parser) {
        $parser->addArgument('controller', [
            'help' => 'Name specific controller'
        ]);
        return $parser;
    }

    public function execute(Arguments $args, ConsoleIo $io) {
        $listController = $this->getListConfig($args);
        if (!empty($listController)) {
            foreach ($listController as $name => $option) {
                $filename = Plugin::path('Backend') . 'src/Controller/Test/' . $name . 'Controller.php';
                $parseConfig = $this->parseFromConfig($option, $name);
                $this->createTemplate($parseConfig, 'controller', $filename);

                $io->out("Creare $name Controller Done");
            }
            $io->out('Done');
        } else {
            $io->out('Cannot found Controller');
        }
    }

}
