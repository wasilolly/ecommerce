<?php

namespace App\Http\Controllers;
use App\Models\Settings;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    
    public function settings(){
        return view('admin.settings',['setting' => Settings::first()]);
    }

    public function updateSettings(){
        
        $setting = Settings::first();
        $setting->update(request()->all());
        return view('admin.settings',['setting' => Settings::first()]);
    }
    
}
