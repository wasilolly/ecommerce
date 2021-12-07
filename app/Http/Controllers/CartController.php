<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Settings;
use App\Models\Product;
use App\Cart;

class CartController extends Controller
{
    public function cart(Request $request)
    {
        // $session =   $request->session()->all();
        //var_dump($session);
        //$request->session()->flush();
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
            return view('storefront.cart', [
                'cart' => $cart,
                'setting' =>  Settings::first()

            ]);
        }

        return view('storefront.cart', [
            'cart' => null,            'setting' =>  Settings::first()
        ]);
    }

    public function add(Request $request)
    {
        $product = Product::find($request->id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->update($product, $request->unit);
        $request->session()->put('cart', $cart);
        $cartQty = $cart->totalQty;

        return response()->json([
            'success' => 'added',
            'product' => $product,
            'cartQty' => $cartQty
        ]);
    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->update($product, $request->unit);
        $request->session()->put('cart', $cart);

        return response()->json([
            'success' => 'updated',
            'unitsTotal' => $cart->products[$request->id]['unitsTotal'],
            'cartQty' => $cart->totalQty,
            'cartTotal' => $cart->totalPrice
        ]);
    }

    public function remove(Request $request)
    {
        $product = Product::find($request->id);
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product->id);
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function checkout()
    {
        if (request()->session()->has('cart')) {
            $cart = request()->session()->get('cart');
        }
        return view('storefront.checkout', [ 'setting' =>  Settings::first(), 
                                             'cart' => $cart,
        ]);
    }

   
}
