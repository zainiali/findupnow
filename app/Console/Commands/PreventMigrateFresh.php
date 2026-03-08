<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreventMigrateFresh extends Command
{
    /**
     * @var string
     */
    protected $signature = 'migrate:fresh';
    /**
     * @var string
     */
    protected $description = 'This command is disabled in this environment.';

    /**
     * @return int
     */
    public function handle()
    {
        $this->error('The migrate:fresh command is disabled.');
        return 1;
    }
}
