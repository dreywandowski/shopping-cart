<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;


class AddTypeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users','user_type')) {
           Schema::table('users', function (Blueprint $table){
               $table->dropColumn('user_type');
           });
        } else {
            Schema::table('users', function (Blueprint $table) {
                $table->string('user_type')->default(User::NORMAL_USER); // add this
            });
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type')->default(User::NORMAL_USER); // add this
        });
    }
}
