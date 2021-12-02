<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * @param string $name
     * 
     * @return string  First letter in category name is capitalized.
     */
    public function getCategoryName($name){
		return ucfirst($name);
	}

    /**
     * Get all of the products for the Category
     *
     * @return \App\Models\Product
     */
    public function getCategoryProducts()
    {
        $products = array();
        $rows = CategoryProduct::where('category_id',$this->id)->get();
        foreach ($rows as $row ) {
            $product = Product::find($row->product_id);
            array_push($products, $product);
        } 
        return $products;
    }
}
