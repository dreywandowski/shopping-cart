<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ref');
            $table->string('customer_name');
            $table->string('amount');
            $table->string('pay_type');
            $table->string('cust_email');
            $table->json('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_orders');
    }
}
