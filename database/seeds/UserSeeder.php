<?php

use Illuminate\Database\Seeder;
use App\User; 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	$user = User::create([ 
            'name'              => 'Admin Admin',  
            'email'				=> 'admin@gmail.com', 
            'password'			=> bcrypt('1234567890'),  
            'email_verified_at'	=> date('Y-m-d H:i:s')
        ]); 
        $user->assignRole('Admin');

        
        $user = User::create([
            'name'              => 'Member Member',  
            'email'				=> 'member@gmail.com',  
            'password'			=> bcrypt('1234567890'), 
            'email_verified_at'	=> date('Y-m-d H:i:s')
        ]); 
        $user->assignRole('User');
    }
}
