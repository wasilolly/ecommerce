<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Cart;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use App\Models\Settings;


class StoreFrontController extends Controller
{
    public function index()
    {
        if(request('search')){
            $products = Product::where('slug', 'like', '%'.request('search').'%')
                            ->orWhere('description', 'like', '%'.request('search').'%')->get();

            return view('storefront.index',[
                'products' => $products,
                'categories' => Category::latest()->get(),
                'setting' =>  Settings::first()
            ]);
        }

        return view('storefront.frontpage',[
            'products' => Product::latest()->get(),
            'categories' => Category::latest()->get(),
            'setting' =>  Settings::first()
        ]);
    }
    public function products()
    {
        return view('storefront.index',[
            'products' => Product::latest()->get(),
            'categories' => Category::latest()->get(),
            'setting' =>  Settings::first()
        ]);
    }

    public function show($slug)
    {    
        $product = Product::where('slug',$slug)->first(); 
 
        return view('storefront.show',[
            'product' => $product,
            'categories' => $product->getProductCategories(),
            'similarProducts' => $product->getSimilarProducts(),
            'setting' =>  Settings::first()
        ]);
        
    }

    public function category($slug)
    {
        $category =  Category::where('slug', $slug)->first();
        return view('storefront.category',[
            'category' => $category,
            'products' => $category->getCategoryProducts(),
            'setting' =>  Settings::first()
        ]);
    }

    public function categories()
    {
        return view('storefront.categories',[
            'categories' => Category::latest()->get(),
            'setting' =>  Settings::first()
        ]);
    }

    
    
}
