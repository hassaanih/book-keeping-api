<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('initiator_id')->nullable(false);
            $table->integer('manager_id')->nullable(true);
            $table->float('balance', 32, 2)->nullable(false);
            $table->float('converted_amount', 32, 2)->nullable(false);
            $table->text('target_currency_id')->nullable(false);
            $table->text('recieving_currency_id')->nullable(false);
            $table->float('commision', 32, 2)->default(0);
            $table->string('otp_for_transaction')->nullable(true);
            $table->enum('transaction_status', ['Pending for Approval', 'Approved', 'Completed', 'Rejected'])->default('Pending for Approval');
            $table->text('reason_for_reject')->nullable(true);
            $table->integer('recieved_by_user_id')->nullable(true);
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
        Schema::dropIfExists('transactions');
    }
}
