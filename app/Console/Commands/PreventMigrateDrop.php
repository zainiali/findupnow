<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreventMigrateDrop extends Command
{
    /**
     * @var string
     */
    protected $signature = 'migrate:rollback';
    /**
     * @var string
     */
    protected $description = 'This command is disabled in this environment.';

    /**
     * @return int
     */
    public function handle()
    {
        $this->error('The migrate:rollback command is disabled.');
        return 1;
    }
}
