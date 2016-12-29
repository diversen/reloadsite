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
        );
    }

    /**
     * Run the reload command
     * @return type
     */
    public function runCommand() {
        return $this->reload();
    }

    /**
     * Reload public files and latest backup
     */
    public function reload() {
        common::needRoot();
        $command = "./coscli.sh db --load-dump";
        common::execCommand($command);

        $command = "./coscli.sh backup --public-restore";
        common::execCommand($command);
    }
}
