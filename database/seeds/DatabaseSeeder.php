<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$this->callDevelopmentSeeders();

		$this->callProductionSeeders();
	}

	protected function callDevelopmentSeeders()
	{
		if ($this->container->environment() != 'production') {
			$this->call(ForumDevelopmentSeeder::class);
		}
	}

	protected function callProductionSeeders()
	{
		if ($this->container->environment() == 'production') {
			$this->call(ForumProductionSeeder::class);
		}
	}
}
