<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use App\Models\Product;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_categories')->truncate();

        $category= Category::find(5);
        $category->products()->detach([50,10,8,5,6]);
        // $product = Product::pluck('id')->first();
    }
}
