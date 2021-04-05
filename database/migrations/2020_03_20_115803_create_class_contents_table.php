<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_contents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('content_type',['Video','Document','Live']);
            //if video
            $table->enum('provider',['Youtube','HTML5','Vimeo','File','Live'])->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedBigInteger('meeting_id')->nullable(); //meeting_id
            $table->integer('duration')->nullable();
            //if document
            $table->string('file')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')
                ->references('id')
                ->on('classes')
                ->onDelete('cascade');
            $table->integer('priority')->default(0);
            $table->boolean('is_published')->default(true);
            $table->boolean('is_preview')->default(false);
            $table->string('source_code')->nullable();
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
        Schema::dropIfExists('class_contents');
    }
}
