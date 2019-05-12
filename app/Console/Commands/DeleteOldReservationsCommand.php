<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservations;
use App\reservedHours;
use Carbon\Carbon;

class DeleteOldReservationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:oldreservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears older reservations then one month.';

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
        $reservedhours = reservedHours::where('created_at', '<=', Carbon::now()->subMonth())->delete();

        $reservation = Reservations::where('created_at', '<=', Carbon::now()->subMonth())->delete();
        $this->info('torolve');
    }
}
