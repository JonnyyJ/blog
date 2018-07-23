<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear the users table
        User::truncate();

        $faker=\Faker\Factory::create();

        //hash method
        $password=Hash::make('toptal');

        User::create([
            'name'=>'Administrator',
            'email'=>'admin@test.com',
            'password'=>$password,
        ]);

        //generate a few dozen users for our app:
        for($i=0;$i<10;$i++){
            User::create([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>$password,

            ]);
        }
    }
}
