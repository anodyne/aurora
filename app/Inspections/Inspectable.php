<?php namespace App\Inspections;

interface Inspectable
{
	public function inspect($text, $model = null);
}
