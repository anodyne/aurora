<?php

use Illuminate\Database\Seeder;

class ForumDevelopmentSeeder extends Seeder
{
	public function run()
	{
		$faker = Faker\Factory::create();

		for ($t = 1; $t <= 10; $t++) {
			factory('App\Data\Topic')->create();
		}

		for ($d = 1; $d <= 50; $d++) {
			$discussion = factory('App\Data\Discussion')->create([
				'user_id' => $faker->numberBetween(1, 100),
				'topic_id' => $faker->numberBetween(1, 10),
			]);

			for ($r = 0; $r <= $faker->numberBetween(0, 10); $r++) {
				factory('App\Data\Reply')->create([
					'discussion_id' => $discussion->id,
					'user_id' => $faker->numberBetween(1, 100),
				]);
			}
		}
	}
}
