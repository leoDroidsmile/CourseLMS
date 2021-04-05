<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();

            $table->string('meeting_id', 191);
            $table->integer('user_id')->nullable();
            $table->string('owner_id', 191);
            $table->longText('meeting_title')->nullable();
            $table->dateTime('start_time');
            $table->longText('zoom_url', 191);
            $table->longText('link_by')->nullable();
            $table->longText('type')->nullable();
            $table->longText('agenda')->nullable();
            $table->integer('course_id')->nullable();
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
        Schema::dropIfExists('meetings');
    }
}
