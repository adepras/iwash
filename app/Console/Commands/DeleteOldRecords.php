<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DeleteOldRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:old-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete records older than 3 minutes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $threshold = $now->subMinutes(3);

        DB::table('bookings')
        ->where('status', 'pending')
            ->where('created_at', '<', $threshold)
            ->delete();
        DB::table('bookings')
        ->where('status', 'canceled')
            ->where('created_at', '<', $threshold)
            ->delete();

        $this->info('Old records deleted successfully.');
        
        return 0;
    }
}
