<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreventMigrateReset extends Command
{
    /**
     * @var string
     */
    protected $signature = 'migrate:reset';
    /**
     * @var string
     */
    protected $description = 'This command is disabled in this environment.';

    /**
     * @return int
     */
    public function handle()
    {
        $this->error('The migrate:reset command is disabled.');
        return 1;
    }
}
