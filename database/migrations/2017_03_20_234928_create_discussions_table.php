<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration
{
    public function up()
    {
        Schema::create('forum_discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('topic_id')->unsigned();
            $table->bigInteger('answer_id')->unsigned()->nullable();
            $table->integer('replies_count')->default(0);
            $table->string('title');
            $table->longText('body');
            //$table->string('slug');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum_discussions');
    }
}
