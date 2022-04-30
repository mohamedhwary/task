<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('categories')->truncate();
        $faker = Faker::create();
        for ($i=0; $i < 20 ; $i++) { 
            $category = Category::create([
                'name' => $faker->sentence(1)
            ]);
        }
    }
}
