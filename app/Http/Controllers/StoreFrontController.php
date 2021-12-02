<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use App\Models\Settings;


class StoreFrontController extends Controller
{
    public function index()
    {
        return view('storefront.index',[
            'products' => Product::latest()->get(),
            'categories' => Category::latest()->get(),
        ]);
    }

    public function show($slug)
    {    
        $product = Product::where('slug',$slug)->first();       
        //$similarProducts  = $this->getSimilarProducts($product->id);
        return view('storefront.show',[
            'product' => $product,
            'categories' => $product->getProductCategories(),
            'similarProducts' => $product->getSimilarProducts()
        ]);
        
    }

    public function category($slug)
    {
        $category =  Category::where('slug', $slug)->first();
        return view('storefront.category',[
            'category' => $category,
            'products' => $category->getCategoryProducts()
        ]);
    }

    
    
}
