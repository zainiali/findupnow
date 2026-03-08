<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Modules\GlobalSetting\app\Models\Setting;

class RemoveLogoBackground extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logo:remove-background 
                            {--color=#FFFFFF : Background color to remove (hex format)}
                            {--tolerance=10 : Color matching tolerance (0-100)}
                            {--no-backup : Skip creating backup of original file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove background from the current logo file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting logo background removal...');

        // Get current logo from settings
        $logoSetting = Setting::where('key', 'logo')->first();
        
        if (!$logoSetting || !$logoSetting->value) {
            $this->error('No logo found in settings.');
            return 1;
        }

        $logoPath = $logoSetting->value;
        $this->info("Processing logo: {$logoPath}");

        // Get options
        $backgroundColor = $this->option('color');
        $tolerance = (int) $this->option('tolerance');
        $backupOriginal = !$this->option('no-backup');

        if ($backupOriginal) {
            $this->info('Creating backup of original file...');
        }

        // Remove background
        $result = removeImageBackground(
            $logoPath,
            $backgroundColor,
            $tolerance,
            $backupOriginal
        );

        if ($result === false) {
            $this->error('Failed to remove background from logo.');
            return 1;
        }

        // Update setting if path changed
        if ($result !== $logoPath) {
            $logoSetting->value = $result;
            $logoSetting->save();
            
            // Clear cache
            Cache::forget('setting');
            
            $this->info("Logo updated to: {$result}");
        } else {
            $this->info("Logo processed successfully: {$result}");
        }

        $this->info('Background removal completed successfully!');
        return 0;
    }
}

