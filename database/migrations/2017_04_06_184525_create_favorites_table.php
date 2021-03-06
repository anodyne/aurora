<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
	public function up()
	{
		Schema::create('forum_favorites', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('user_id')->unsigned();
			$table->integer('favorited_id')->unsigned();
			$table->string('favorited_type', 50);
			$table->timestamps();

			$table->unique(['user_id', 'favorited_id', 'favorited_type']);
		});
	}

	public function down()
	{
		Schema::dropIfExists('forum_favorites');
	}
}
