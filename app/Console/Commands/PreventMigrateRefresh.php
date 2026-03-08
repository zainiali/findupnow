<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PreventMigrateRefresh extends Command
{
    /**
     * @var string
     */
    protected $signature = 'migrate:refresh';
    /**
     * @var string
     */
    protected $description = 'This command is disabled in this environment.';

    /**
     * @return int
     */
    public function handle()
    {
        $this->error('The migrate:refresh command is disabled.');
        return 1; // Return a non-zero status code for failure
    }
}
