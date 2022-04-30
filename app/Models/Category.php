<?php

namespace App\Models;
use App\Models\Product as PR;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(PR::class,'products_categories','category_id',"product_id");
    }
}
