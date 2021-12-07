<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = 0;
        $orders = Order::all('cart');
        $orders->map(function($order, $key){
            $order->cart = unserialize($order->cart);
        });
        foreach ($orders as $order) {
            $sales += $order->cart->totalPrice;
        }
        return view('admin.product.index', ['products' => Product::latest()->get(),
                                                'sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', ['categories' => Category::latest()->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'categories' => 'required'
        ]);


        $product = new Product;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products');
            $product->image = $path;
        }

        $product->slug = Str::slug($request->name);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->save();

        if ($request->has('categories')) {
            foreach ($request->categories as $category) {
                CategoryProduct::create([
                    'product_id' => $product->id,
                    'category_id' => $category
                ]);
            }
        }

        return redirect(route('product.index'))->with('sucess','New Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.product.show', [
            'product' => Product::find($id),
            'categories' => Category::latest()->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $attributes = $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products');
            $attributes['image'] = $path;
        }

        $attributes['slug'] = Str::slug($request->name);
        $product->update($attributes);

        //if user has chosen to assign a category to the product
        if ($request->has('categories')) {
            foreach ($request->categories as $category) { 
                //check if the products has not been assigned to the category         
                if (!$this->alreadyAssigned($product->id,$category)){
                    CategoryProduct::create([
                        'product_id' => $product->id,
                        'category_id' => $category
                    ]);
                }
            }
        }
       
        return redirect(route('product.index'))->with('success','Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryProduct::where('product_id', $id)->delete();
        Product::where('id', $id)->delete();
        return redirect(route('product.index'))->with('success', 'Product removed!');
    }

    /**
     * Check if category is already assigned to the product
     *
     * @param [type] $product_id
     * @param [type] $category_id
     * @return boolean
     */
    public function alreadyAssigned($product_id, $category_id)
    {
        //check if the products has not been assigned to the category
        $assigned = CategoryProduct::where('product_id', $product_id)
            ->where('category_id', $category_id)
            ->first();

        if (isset($assigned)) {
            return true;
        }
        return false;
    }
}
