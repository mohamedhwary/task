<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('products')->truncate();
        $faker = Faker::create();
        $user = User::pluck('id')->first();
        for ($i=0; $i < 1000 ; $i++) { 
            $product = Product::create([
                'name' => $faker->sentence(2),
                'description' => $faker->paragraph(),
                'quantity' => $faker->numberBetween(1,9),
                'price' => $faker->randomDigit(),
                'image' => $faker->imageUrl($width = 200, $height = 200),
                'user_id' => $user,
            ]);
        }
    }
}
