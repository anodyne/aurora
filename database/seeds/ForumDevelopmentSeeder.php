<?php

use Illuminate\Database\Seeder;

class ForumDevelopmentSeeder extends Seeder
{
	public function run()
	{
		$this->seedTopics();

		$faker = Faker\Factory::create();

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

	protected function seedTopics()
	{
		$data = [
			['name' => "Nova", 'slug' => "nova-general", 'color' => "#259b24", 'description' => ""],
			['name' => "Anodyne Lounge", 'slug' => "anodyne-lounge", 'color' => "#607d8b", 'description' => ""],
			['name' => "Announcements", 'slug' => "announcements", 'color' => "#607d8b", 'description' => ""],
			['name' => "AnodyneXtras", 'slug' => "xtras", 'color' => "#d81b60", 'description' => ""],
			['name' => "Help Center", 'slug' => "help-center", 'color' => "#0288d1", 'description' => ""],
			
			// Nova sub topics
			['name' => "Help", 'slug' => "nova-help", 'color' => "#259b24", 'description' => "", 'parent_id' => 1],
			['name' => "Themeing", 'slug' => "nova-themeing", 'color' => "#259b24", 'description' => "", 'parent_id' => 1],
			['name' => "Nova NextGen", 'slug' => "nova-nextgen", 'color' => "#259b24", 'description' => "", 'parent_id' => 1],

			// AnodyneXtras sub topics
			['name' => "Xtras Discussions", 'slug' => "xtras-discussion", 'color' => "#d81b60", 'description' => "", 'parent_id' => 4],

			// Help Center sub topics
			['name' => "Article Discussions", 'slug' => "help-center-articles", 'color' => "#0288d1", 'description' => "", 'parent_id' => 5],
		];

		foreach ($data as $d)
		{
			Topic::create($d);
		}
	}
}
