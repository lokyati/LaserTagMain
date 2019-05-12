<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservations;
use App\reservedHours;
use Carbon\Carbon;

class NewPageStatRowCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:page_stat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes a new row in page_stat table';

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
        
    }
}
