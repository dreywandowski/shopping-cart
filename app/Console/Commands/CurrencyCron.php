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
        $currencies_to_convert = array("CNY", "ZAR","GBP", "EUR","USD");
        $api_key = config('app.rapid_api_exchange');
        $rates = array();
// loop 2ru each of the currencies and convert to the naira value
        foreach ($currencies_to_convert as $currency) {

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://currency-conversion-and-exchange-rates.p.rapidapi.com/convert?from=" . $currency . "&to=NGN&amount=1",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: currency-conversion-and-exchange-rates.p.rapidapi.com",
                    "X-RapidAPI-Key: $api_key"
                ],
            ]);

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
                if($currency == "USD") $word = "United States Dollar";
                else if($currency == "EUR") $word = "Euro";
                else if($currency == "GBP") $word = "Great British Pound";
                else if($currency == "CNY") $word = "Chinese Yuan";
                else if($currency == "ZAR") $word = "South African Rand";

                        $convert = new Fx_rates();
                        $convert->base_curr = "NGN";
                        $convert->target_curr = $currency;
                        $convert->online_forex_rate = $res;
                        $convert->desc = $word;
                        $convert->save();

                        $rates['target_curr']       = $currency;
                        $rates['desc']              = $word;
                        $rates['online_forex_rate'] = $res;

                        $mailData[] = $rates;

                /*echo "<pre>"."penultimate Array";
                print_r($rates);
                echo "</pre>";
                echo "<br>";*/

                }
            }

       /* ini_set('display_errors',1);
        echo "<pre>"."finallll";
                print_r($mailData);
                echo "</pre>";
                echo "<br>";*/

        // send the rates to my email
        \Mail::to('aduramimo@gmail.com','Dreywandowski')->send(new ExchangeRates($mailData));

        }

}
