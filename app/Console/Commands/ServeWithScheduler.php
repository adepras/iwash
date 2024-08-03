<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeWithScheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve:with-scheduler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Laravel development server and scheduler';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Start the Laravel development server
        $this->info('Starting Laravel development server...');
        $server = new Process(['php', 'artisan', 'serve']);
        $server->start();

        // Start the scheduler
        $this->info('Starting scheduler...');
        $scheduler = new Process(['php', 'artisan', 'schedule:work']);
        $scheduler->start();

        // Output the server and scheduler logs
        while ($server->isRunning() && $scheduler->isRunning()) {
            usleep(500000); // 0.5 seconds
            if ($output = $server->getIncrementalOutput()) {
                $this->info($output);
            }
            if ($output = $scheduler->getIncrementalOutput()) {
                $this->info($output);
            }
            if ($output = $server->getIncrementalErrorOutput()) {
                $this->error($output);
            }
            if ($output = $scheduler->getIncrementalErrorOutput()) {
                $this->error($output);
            }
        }

        return 0;
    }
}

