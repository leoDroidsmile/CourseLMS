<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_earnings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('enrollment_id')->unsigned();
            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            //package
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');

            $table->double('course_price');
            $table->double('will_get');
            //instructor
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('instructor_earnings');
    }
}
