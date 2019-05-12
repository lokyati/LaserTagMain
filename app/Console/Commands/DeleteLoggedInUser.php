<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\LoggedInUsers;
use Carbon\Carbon;

class DeleteLoggedInUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:oldlogin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears older logins then 30 minutes.';

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
        $loggedinuser = LoggedInUsers::where('updated_at', '<', Carbon::now()->subMinutes(30))->delete();
        $this->info('torolve');
    }
}
