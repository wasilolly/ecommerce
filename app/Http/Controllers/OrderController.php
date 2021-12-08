<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Settings;
use App\Models\User;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function save()
    {
        $attribute = request()->validate([
            'address' => 'required',
            'card' => 'required'
        ]);
       $attribute['message'] =  request()->has('message') ? request('message')  : null;
       if(request('name')){
           $attribute['name'] = request('name');
           $attribute['email'] = request('email');
       }else{
           $user = User::find(auth()->id());
           $attribute['user_id'] = $user->id;
           $attribute['name'] = $user->name;
           $attribute['email'] = $user->email;
        }
        $this->decrProductsQty();
        $attribute['cart'] = serialize(session('cart'));
        $order = Order::create($attribute);

        //remove cart from session
        request()->session()->flush('cart');

        return redirect(route('userOrders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        $order->cart = unserialize($order->cart);
        return view('storefront.order', [
                'setting' => Settings::first(),
                'order' => $order
            ]);
    }

    public function decrProductsQty()
    {
        $cart = session('cart');
        foreach ($cart->products as $item) {
            $product = Product::find($item['product']['id']);
            $product->quantity -= $item['units'];
            $product->sold += $item['units'];
            $product->update();
        }
    }

    public function userOrders()
    {
        $userId = Auth()->user()->id;
        $orders = Order::where('user_id',$userId)->get();
        $orders->map(function($order, $key){
            $order->cart = unserialize($order->cart);
        });
       
        return view('auth.dashboard', [
                'setting' => Settings::first(),
                'orders' => $orders
            ]);
    }
}
