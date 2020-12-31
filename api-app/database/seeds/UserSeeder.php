<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => "admin",
                'last_name' => "admin",
                'email' => 'admin'.'@mail.co',
                'password' => Hash::make('123456'),
                'api_token' => Str::random(100),
                'age' => rand(18, 35),
            ],            
        ]);
    }
}
