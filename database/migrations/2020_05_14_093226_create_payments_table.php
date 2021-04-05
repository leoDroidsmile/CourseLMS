<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->double('current_balance')->nullable();
            $table->enum('process',['Bank','Paypal','Stripe']);
            $table->unsignedBigInteger('account_id');
            $table->foreign('account_id')
                ->references('id')
                ->on('instructor_accounts')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->enum('status',['Request','Confirm']);
            $table->dateTime('status_change_date')->nullable();
            $table->bigInteger('user_id')->unsigned(); //Which Instructor send request
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('payments');
    }
}
