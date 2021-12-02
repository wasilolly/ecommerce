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
     * Get the categories for the product
     *
     * @return \App\Models\Category
     */
    public function getProductCategories()
    {
        $categories = array();
        $rows = CategoryProduct::where('product_id',$this->id)->get();
        foreach ($rows as $row ) {
            $category = Category::find($row->category_id);
            array_push($categories, $category);
        } 
        return $categories;
    }

    /**
     * Get the similar products
     *
     * @return \App\Models\Product
     */
    public function getSimilarProducts()
    {
        $similarProducts = array();

        //get the first row product and its category
        $row = CategoryProduct::where('product_id',$this->id)->first();

        //take 4 rows that matched the assigned categoryid
        $categoryproducts = CategoryProduct::where('category_id', $row->category_id)->take(4)->get();

        foreach ($categoryproducts as $categoryproduct) {
            $product = Product::find($categoryproduct->product_id);
            array_push($similarProducts, $product);
        }
        return $similarProducts;
    }
}
