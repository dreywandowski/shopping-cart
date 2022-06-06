<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fx_rates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('base_curr');
            $table->string('target_curr');
            $table->double('online_forex_rate');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fx_rates');
    }
}
