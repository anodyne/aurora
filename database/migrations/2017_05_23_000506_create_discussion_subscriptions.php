<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionSubscriptions extends Migration
{
    public function up()
    {
        Schema::create('discussions_subscriptions', function (Blueprint $table) {
        	$table->bigIncrements('id');
			$table->integer('user_id')->unsigned();
			$table->integer('discussion_id')->unsigned();
			$table->timestamps();
			$table->unique(['user_id', 'discussion_id']);
		});
    }

    public function down()
    {
        Schema::dropIfExists('discussions_subscriptions');
    }
}
