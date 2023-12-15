<?php

namespace App\Console\Commands;

use App\Mail\ExchangeRates;
use Illuminate\Console\Command;
use App\Models\Fx_rates;

class CurrencyCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'curr:cron';

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

        // Write your database logic  bellow:
        $currencies_to_convert = array("CNY", "ZAR", "GBP", "EUR", "USD","CAD");
        $api_key = config('app.fixer_api_exchange');
        $rates = array();
        
// loop 2ru each of the currencies and convert to the naira value
        foreach ($currencies_to_convert as $currency) {

            $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => config('app.exchange_rates').$currency."&amount=1",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: text/plain",
    "apikey: $api_key"
  ),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET"
));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
                echo "<br>";
            } else {
                $response = json_decode($response, true);
                $res = $response['result'];

                $word = "";
                if ($currency == "USD") $word = "United States Dollar";
                else if ($currency == "EUR") $word = "Euro";
                else if ($currency == "GBP") $word = "Great British Pound";
                else if ($currency == "CNY") $word = "Chinese Yuan";
                else if ($currency == "ZAR") $word = "South African Rand";
                else if ($currency == "CAD") $word = "Canadian Dollar";

/*        
                // delete previous records off the db to have just one day record
                $old = Fx_rates::orderBy('target_curr', 'asc')->first()->toArray();
                $old_curr = $old['id'];

                try{
                    $del_old = Fx_rates::where('id',$old_curr)->delete();
                    echo "previous rates deleted sucessfully";
                }
                catch(\Illuminate\Database\QueryException $e){
                   echo "error removing db entries..".$e;

                }
  */            
                $convert = new Fx_rates();

                $convert->base_curr = "NGN";
                $convert->target_curr = $currency;
                $convert->online_forex_rate = $res;
                $convert->desc = $word;
                $convert->save();

                $rates['target_curr'] = $currency;
                $rates['desc'] = $word;
                $rates['online_forex_rate'] = $res;

                $mailData[] = $rates;

                /*echo "<pre>"."penultimate Array";
                print_r($response);
                echo "</pre>";
                echo "<br>";*/

            }
        }

        /* ini_set('display_errors',1);
         echo "<pre>"."finallll";
                 print_r($mailData);
                 echo "</pre>";
                 echo "<br>";*/


        $mails = array('waspery4love@yahoo.com',
                       'farajayh@gmail.com',
                       'michaelwrites01@gmail.com',
                       'aduramimo@gmail.com');

            // send the rates to my email
         //   \Mail::to('aduramimo@gmail.com', 'Dreywandowski')->send(new ExchangeRates($mailData));

            // multiple mails
           /* foreach($mails as $mail){
          \Mail::to($mail)->send(new ExchangeRates($mailData));
            }*/
    }

}
