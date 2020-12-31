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
                'first_name' => "Jose",
                'last_name' => "Tirado",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123456'),
                'api_token' => Str::random(100),
                'age' => rand(18, 35),
            ],
            [
                'first_name' => "Juan",
                'last_name' => "Tirado",
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('123456'),
                'api_token' => Str::random(100),
                'age' => rand(18, 35),
            ]
            
        ]);
    }
}
