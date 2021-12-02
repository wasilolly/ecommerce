<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryProduct extends Pivot
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['product_id', 'category_id'];

     

    

    
}
