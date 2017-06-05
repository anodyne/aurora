<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
	public function up()
	{
		Schema::create('forum_announcements', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('title');
			$table->text('body');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('forum_announcements');
	}
}
