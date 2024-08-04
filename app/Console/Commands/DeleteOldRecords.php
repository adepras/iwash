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
    protected $description = 'Hapus data booking yang sudah lama (lebih dari 3 menit) dan statusnya masih pending atau canceled';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $threshold = $now->subMinutes(5);

        DB::table('bookings')
        ->where('status', 'pending')
            ->where('created_at', '<', $threshold)
            ->delete();
        DB::table('bookings')
        ->where('status', 'canceled')
            ->where('created_at', '<', $threshold)
            ->delete();

        $this->info('Data booking yang sudah lama berhasil dihapus.');
        
        return 0;
    }
}
