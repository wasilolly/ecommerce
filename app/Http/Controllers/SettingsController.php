<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use App\Models\User;
use App\Models\Order;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.settings', ['setting' => Settings::first()]);
    }

    public function updateSettings()
    {

        $setting = Settings::first();
        $setting->update(request()->all());
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

        } else {
            $user->admin = 1;
        }
        
        $user->update();

        return view('admin.users',
            [
                'setting' => Settings::first(),
                'users' => User::latest()->get()
            ]
        );
    }
    public function notadmin($id)
    {
        $user = User::find($id);
        $user->admin = 0;
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
        $orders = Order::latest()->get();
        $orders->map(function($order, $key){
            $order->cart = unserialize($order->cart);
        });
        return view('admin.orders', [
                'setting' => Settings::first(),
                'orders' => $orders
            ]);
    }
}
