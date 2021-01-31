<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteTransaksi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:transaksi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus Transaksi lebih dari 1 Hari';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('transaksi')->where('created_at', '<=', Carbon::now()->subDay())->delete();
    }
}
