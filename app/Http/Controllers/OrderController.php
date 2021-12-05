<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        $attribute['cart'] = serialize(session('cart'));
        Order::create($attribute);

        return 'Order created';
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
}
