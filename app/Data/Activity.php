<?php namespace App\Data;

use Eloquent;

class Activity extends Eloquent
{
	protected $fillable = ['user_id', 'type', 'subject_id', 'subject_type'];

	//--------------------------------------------------------------------------
	// Relationships
	//--------------------------------------------------------------------------

	public function subject()
	{
		return $this->morphTo();
	}
}
