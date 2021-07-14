<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
			'Admin',
			'User', 
		];
		foreach ($permissions as $permission) {
			Role::create(['name' => $permission]);
		}
    }
}
