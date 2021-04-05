<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->string('wallet_name')->nullable();
            $table->string('wallet_icon')->nullable();
            $table->double('wallet_rate')->nullable();
            $table->double('redeem_limit')->nullable();
            $table->double('registration_point')->nullable();
            $table->double('free_course_point')->nullable();
            $table->double('paid_course_point')->nullable();
            $table->double('course_complete_point')->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
