<?php

namespace App\Models;
use App\User;
use App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class,'products_categories','product_id',"category_id");
    }
}
