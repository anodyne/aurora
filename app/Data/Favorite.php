<?php namespace App\Data;

use Eloquent;

class Favorite extends Eloquent
{
	protected $table = 'favorites';
	protected $fillable = ['user_id', 'favorited_id', 'favorited_type'];
}
