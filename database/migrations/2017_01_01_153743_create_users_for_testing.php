<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersForTesting extends Migration
{
	public function up()
	{
		//if (app()->environment() == 'testing') {
			Schema::create('core_users', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('username')->unique();
				$table->string('email')->unique();
				$table->string('password');
				$table->rememberToken();
				$table->text('url')->nullable();
				$table->text('bio')->nullable();
				$table->string('twitter')->nullable();
				$table->string('facebook')->nullable();
				$table->string('google')->nullable();
				$table->timestamps();
				$table->softDeletes();
			});

			Schema::create('core_password_resets', function (Blueprint $table) {
				$table->string('email')->index();
				$table->string('token');
				$table->timestamp('created_at')->nullable();
			});

			Schema::create('core_sessions', function (Blueprint $table) {
				$table->string('id')->unique();
				$table->unsignedInteger('user_id')->nullable();
				$table->string('ip_address', 45)->nullable();
				$table->text('user_agent')->nullable();
				$table->text('payload');
				$table->integer('last_activity');
			});

			Schema::create('core_roles', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name')->unique();
				$table->timestamps();
			});

			Schema::create('core_permissions', function (Blueprint $table) {
				$table->increments('id');
				$table->string('key');
				$table->string('name');
				$table->timestamps();
			});

			Schema::create('core_users_roles', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedInteger('user_id');
				$table->unsignedInteger('role_id');
				$table->foreign('user_id')->references('id')->on('core_users');
				$table->foreign('role_id')->references('id')->on('core_roles');
			});

			Schema::create('core_permissions_roles', function (Blueprint $table) {
				$table->increments('id');
				$table->unsignedInteger('permission_id');
				$table->unsignedInteger('role_id');
				$table->foreign('permission_id')->references('id')->on('core_permissions');
				$table->foreign('role_id')->references('id')->on('core_roles');
			});

			Eloquent::unguard();

			$this->seed();
		//}
	}

	public function down()
	{
		Schema::dropIfExists('core_password_resets');
		Schema::dropIfExists('core_sessions');
		Schema::dropIfExists('core_permissions_roles');
		Schema::dropIfExists('core_users_roles');
		Schema::dropIfExists('core_permissions');
		Schema::dropIfExists('core_roles');
		Schema::dropIfExists('core_users');
	}

	protected function seed()
	{
		$this->permissions();
		$this->roles();
		$this->roleAssignments();
	}

	protected function permissions()
	{
		$permissions = [
			['key' => 'xtras.item.create', 'name' => "Create Xtra"],
			['key' => 'xtras.item.edit', 'name' => "Edit Xtra"],
			['key' => 'xtras.item.delete', 'name' => "Delete Xtra"],
			['key' => 'xtras.item.upload', 'name' => "Upload Files"],
			['key' => 'xtras.item.skins', 'name' => "Skin Xtras"],
			['key' => 'xtras.item.mods', 'name' => "MOD Xtras"],
			['key' => 'xtras.item.ranks', 'name' => "Rank Xtras"],
			['key' => 'xtras.admin', 'name' => "Xtras Admin"],

			['key' => 'help.admin', 'name' => "Help Center Admin"],
			['key' => 'help.article.create', 'name' => "Create Article"],
			['key' => 'help.article.edit', 'name' => "Edit Article"],
			['key' => 'help.article.delete', 'name' => "Delete Article"],

			['key' => 'www.admin', 'name' => "Main Site Admin"],
			['key' => 'www.admin.users', 'name' => "Manage Users"],
			['key' => 'www.admin.authorization', 'name' => "Manage Authorization"],

			['key' => 'forums.discussion.create', 'name' => "Create Discussion"],
			['key' => 'forums.discussion.edit', 'name' => "Edit Discussion"],
			['key' => 'forums.discussion.delete', 'name' => "Delete Discussion"],
			['key' => 'forums.post.create', 'name' => "Create Discussion Post"],
			['key' => 'forums.post.edit', 'name' => "Edit Discussion Post"],
			['key' => 'forums.post.delete', 'name' => "Delete Discussion Post"],
			['key' => 'forums.topic.create', 'name' => "Create Forum Topic"],
			['key' => 'forums.topic.edit', 'name' => "Edit Forum Topic"],
			['key' => 'forums.topic.delete', 'name' => "Delete Forum Topic"],
		];

		foreach ($permissions as $permission) {
			App\Data\Permission::create($permission);
		}
	}

	protected function roles()
	{
		$roles = [
			['name' => "Xtras Administrator"],
			['name' => "Xtras Moderator"],
			['name' => "Xtras User"],
			['name' => "Xtras Skins"],
			['name' => "Xtras MODs"],
			['name' => "Xtras Ranks"],
			['name' => "Help Center Administrator"],
			['name' => "Help Center Moderator"],
			['name' => "Help Center User"],
			['name' => "Help Center Article Author"],
			['name' => "Users Administrator"],
			['name' => "Suspended User"],
			['name' => "Forums Administrator"],
			['name' => "Forums Moderator"],
			['name' => "Forums User"],
		];

		foreach ($roles as $role) {
			App\Data\Role::create($role);
		}
	}

	protected function roleAssignments()
	{
		$assignments = [
			"Xtras Administrator" => ['xtras.admin'],
			"Xtras Moderator" => [],
			"Xtras User" => ['xtras.item.create', 'xtras.item.edit', 'xtras.item.delete', 'xtras.item.upload'],
			"Xtras Skins" => ['xtras.item.skins'],
			"Xtras MODs" => ['xtras.item.mods'],
			"Xtras Ranks" => ['xtras.item.ranks'],

			"Help Center Administrator" => ['help.admin'],
			"Help Center Moderator" => [],
			"Help Center User" => [],
			"Help Center Article Author" => ['help.article.create', 'help.article.edit', 'help.article.delete'],

			"Users Administrator" => ['www.admin', 'www.admin.users', 'www.admin.authorization'],

			"Forums Administrator" => ['forums.topic.create', 'forums.topic.edit', 'forums.topic.delete'],
			"Forums Moderator" => ['forums.discussion.edit', 'forums.discussion.delete', 'forums.post.edit', 'forums.post.delete'],
			"Forums User" => ['forums.discussion.create', 'forums.post.create'],
		];

		foreach ($assignments as $roleName => $permissionKeys) {
			// Find the role
			$role = App\Data\Role::where('name', $roleName)->first();

			if ($role) {
				// Find the permission IDs
				$permissionIds = App\Data\Permission::whereIn('key', $permissionKeys)
					->get()
					->map(function ($p) {
						return $p->id;
					});

				if ($permissionIds->count() > 0) {
					// Associate the permissions with the role
					$role->perms()->attach($permissionIds->all());
				}
			}
		}
	}
}
