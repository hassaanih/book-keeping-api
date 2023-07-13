<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCurrencyCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_currency_credit', function (Blueprint $table) {
            $table->id();
            $table->integer('currency_id')->nullable(false);
            $table->text('currency_id_name')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->float('credit_balance', 50, 2)->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_currency_credit');
    }
}
