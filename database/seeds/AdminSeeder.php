<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate([
                'email' => 'admin@social_network.com',
        ], [
            "name" =>  "Admin",
            "phone" => "09435353453",
            "birthday" => "1995-10-10",
            "avatar" => "/images/user-male.png",
            "gender" =>  1,
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole('admin');
    }
}
