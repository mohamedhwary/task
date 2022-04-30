<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker::create();
        for ($i=0; $i < 99 ; $i++) { 
            $User = User::create([
                'name' => Str::random(12),
                'email' => Str::random(4).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
