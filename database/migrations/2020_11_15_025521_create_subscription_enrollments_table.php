<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionEnrollmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_enrollments', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_package');
            $table->double('subscription_price');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->softDeletes();
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
        Schema::dropIfExists('subscription_enrollments');
    }
}
