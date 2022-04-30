<?php

namespace App\Console\Commands;

use App\Models\Archive;
use Illuminate\Console\Command;
use App\Models\Category;
use \App\Models\Product;
use \App\User;
use SebastianBergmann\Environment\Console;

class SaveTotalArchive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'saveTotalArchive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'save total of records for(products, categories, and users) every day at 12:00 AM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::count();
        $Product = Product::count();
        $Category = Category::count();

        $archive = Archive::create([
            'user_n'    => $user,
            'product_n' => $Product,
            'category_n' => $Category
        ]);
        Console::info('Archive created successfully'); 
    }
}
