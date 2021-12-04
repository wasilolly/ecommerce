<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {   
        $product =Product::find($request->id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $request->unit);
        $request->session()->put('cart', $cart);
        $productCount = $cart->totalQty;
        
        return response()->json(['success' => 'added',
                                'product'=> $product,
                                'qty' => $productCount
                            ]);
    }

    public function cart(Request $request)
    {
       // $session =   $request->session()->all();
        //var_dump($session);

        if($request->session()->has('cart')){
            $cart = $request->session()->get('cart');
            return view('storefront.cart',['cart' => $cart]);
        }
        
       return view('storefront.cart', ['cart' => null]);
    }

    public function remove(Request $request)
    {
        $product =Product::find($request->id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product->id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }
}
