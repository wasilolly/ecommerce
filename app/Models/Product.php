<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'image', 'price', 
		 'description', 'quantity'
    ];

    /**
     * @param string $name
     * 
     * @return string  First letter in product name capitalized.
     */
    public function getProductName($name){
		return ucfirst($name);
	}

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product_table', 'category_id', 'product_id');
    }
}
