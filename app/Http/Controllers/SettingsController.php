<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use App\Models\Order;

use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function settings()
    {
        return view('admin.settings', ['setting' => Settings::first()]);
    }

    public function updateSettings()
    {
        $setting = Settings::first();
        $setting->update(request()->all());
        request()->session()->flash('success','Settings Updated!');
        return view('admin.settings', ['setting' => Settings::first()]);
    }

    public function users()
    {
        return view('admin.users',
            [
                'setting' => Settings::first(),
                'users' => User::latest()->get()
            ]
        );
    }

    public function userDestroy($id)
    {
        request()->session()->flash('success','User Deleted!');
        return view('admin.users',
            [
                'setting' => Settings::first(),
                'users' => User::latest()->get()
            ]
        );
    }

    public function admin($id)
    {
        $user = User::find($id);
        if ($user->admin) {
            $user->admin = 0;
            request()->session()->flash('success','Admin priviledge revoked for this user!');

        } else {
            $user->admin = 1;
            request()->session()->flash('success','Admin priviledge added for this user!');
        }
        
        $user->update();

        return view('admin.users',
            [
                'setting' => Settings::first(),
                'users' => User::latest()->get()
            ]
        );
    }
   
    public function orders()
    {
        $sales = 0;
        $orders = Order::latest()->get();
        $orders->map(function($order, $key){
            $order->cart = unserialize($order->cart);
        });
        foreach ($orders as $order) {
            $sales += $order->cart->totalPrice;
        }
        return view('admin.orders', [
                'setting' => Settings::first(),
                'orders' => $orders,
                'sales' => $sales
            ]);
    }
}
