<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_payments', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->double('current_balance')->nullable();
            $table->enum('process',['Bank','Paypal','Stripe']);
            $table->unsignedBigInteger('student_account_id');
            $table->string('description')->nullable();
            $table->enum('status',['Request','Confirm']);
            $table->dateTime('status_change_date')->nullable();
            $table->bigInteger('user_id')->unsigned(); //Which student send request
            $table->unsignedBigInteger('affiliate_id')->nullable();
            $table->unsignedBigInteger('confirm_by')->nullable(); //admin
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
        Schema::dropIfExists('affiliate_payments');
    }
}
