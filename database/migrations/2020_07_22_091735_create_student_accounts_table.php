<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); //this is student
            $table->string('bank')->default('Bank');
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('routing_number')->nullable();

            $table->string('paypal')->default('Paypal');
            $table->string('paypal_acc_name')->nullable();
            $table->string('paypal_acc_email')->nullable();

            $table->string('stripe')->default('Stripe');
            $table->string('stripe_acc_name')->nullable();
            $table->string('stripe_acc_email')->nullable();
            $table->string('stripe_card_holder_name')->nullable();
            $table->string('stripe_card_number')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
}
