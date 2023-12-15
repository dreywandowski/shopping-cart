<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\DB;
use App\Mail\ExchangeRates;
use Illuminate\Console\Command;
use App\Models\Fx_rates;
use Carbon\Carbon;
use DateTime;

class RemoveOldFx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {

        // Get the current time
$now = Carbon::now();

// Set the time limit for deleting tokens (3 days in this example)
$timeLimit = $now->subDays(2);

// Delete all personal access tokens that were created before the time limit
try{
    $delete = DB::table('fx_rates')
    ->where('created_at', '<', $timeLimit)
    ->delete();
}
catch (\Illuminate\Database\QueryException $e)
{
    echo "error deleting!! ".$e;
}

echo "Deleted OK for today... ".date('Y-m-d')." , items deleted == ".$delete."<br>";
    }

}
