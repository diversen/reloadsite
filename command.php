<?php

namespace modules\reloadsite;

use diversen\cli\common;

class command {

    // ./coscli.sh reload --reload
    public function getHelp() {
        return
                array(
                    'name' => 'reload',
                    'usage' => 'Wrapper command used for reloading site with latest public files and sql backup',
                    'options' => array(
                        '--reload' => 'Command for reloading site files',
                    ),
                    'arguments' => array ()
        );
    }

    /**
     * 
     * @param \diversen\parseArgv $args
     */
    public function runCommand($args) {

        if ($args->getFlag('reload')) {
            return $this->reload();
        }
    }

    public function reload() {
        common::needRoot();
        $command = "./coscli db --load-dump";
        common::execCommand($command);

        $command = "./coscli backup --public-restore";
        common::execCommand($command);
    }

}
