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

class CreateMenuCommand extends Command {

    use CommandService;

    public function execute(Arguments $args, ConsoleIo $io) {
        $filename = Plugin::path('Backend') . 'config/left_menu.php';
        $data['data'] = array_keys(Configure::read('Controller'));
        $this->createTemplate($data, 'left_menu', $filename);

        $io->out("Creeate Menu Done");
        $io->out('Done');
    }

}
