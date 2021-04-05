<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->double('balance')->nullable(); // + = when payment need from admin or cash from instructor
            $table->string('linked')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('skype')->nullable();
            $table->longText('about')->nullable();

            //fk here
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->
            references('id')->on('packages')->onDelete('cascade');
            //this fk for login instructor
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('signature')->nullable();
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
        Schema::dropIfExists('instructors');
    }
}
