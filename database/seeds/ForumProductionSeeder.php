<?php

use Illuminate\Database\Seeder;

class ForumProductionSeeder extends Seeder
{
	public function run()
	{
		$data = [
			['name' => "Nova", 'slug' => "nova-general", 'color' => "#259b24", 'description' => ""],
			['name' => "Anodyne Lounge", 'slug' => "", 'color' => "#607d8b", 'description' => ""],
			['name' => "AnodyneXtras", 'slug' => "xtras", 'color' => "#d81b60", 'description' => ""],
			['name' => "Help Center", 'slug' => "", 'color' => "#0288d1", 'description' => ""],
			
			// Nova sub topics
			['name' => "Help", 'slug' => "nova-help", 'color' => "#259b24", 'description' => "", 'parent_id' => 1],
			['name' => "Themeing", 'slug' => "nova-themeing", 'color' => "#259b24", 'description' => "", 'parent_id' => 1],
			['name' => "Nova NextGen", 'slug' => "nova-nextgen", 'color' => "#259b24", 'description' => "", 'parent_id' => 1],

			// Anodyne Lounge sub topics
			['name' => "Announcements", 'slug' => "", 'color' => "#607d8b", 'description' => "", 'parent_id' => 2],

			// AnodyneXtras sub topics
			['name' => "Xtra Discussions", 'slug' => "xtras-discussion", 'color' => "#d81b60", 'description' => "", 'parent_id' => 3],

			// Help Center sub topics
			['name' => "Article Discussions", 'slug' => "help-center-articles", 'color' => "#0288d1", 'description' => "", 'parent_id' => 4],
		];

		foreach ($data as $d)
		{
			Topic::create($d);
		}
	}
}