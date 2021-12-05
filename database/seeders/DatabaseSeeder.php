<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jane',
            'email' => 'jane@example.com',
            'password' => bcrypt('password')
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'admin' => 1,
            'password' => bcrypt('password')
        ]);

        Category::create([ 'name' => 'chocolate', 'slug' =>'chocolate', 'description'=> 'This is about chocolate']);
        Category::create([ 'name' => 'Vanilla', 'slug' =>'Vanilla', 'description'=> 'This is about vanilla']);
        Category::create([ 'name' => 'StrawBerry', 'slug' =>'strawberry', 'description'=> 'This is about strawberry']);
        Category::create([ 'name' => 'Rasberry', 'slug' =>'rasberry', 'description'=> 'This is about rasberry']);

        Product::create([
            'name' => 'Chocolate Cake candle',
            'slug' => 'chocolate-cake-candle',
            'price' => 100,
            'quantity' => 50,
            'image' => '/products/chocolate.jpg',
            'description' => 'This is the product description'
        ]);

        Product::create([
            'name' => 'Coffee Cake candle',
            'slug' => 'coffee-cake-candle',
            'price' => 100,
            'quantity' => 10,
            'image' => '/products/coffee.jpg',
            'description' => 'This is the product description'
        ]);

        Product::create([
            'name' => 'Dice Cake candle',
            'slug' => 'dice-cake-candle',
            'price' => 100,
            'quantity' => 5,
            'image' => '/products/dice.jpg',
            'description' => 'This is the product description'
        ]);

        \App\Models\Settings::create([
            'about' => 'This is the about section',
            'footer' => 'This is the footer section',
            'banner'=> 'This is a banner',
            'coupon' => '50off',
            'tax' => 10
        ]);

    }
}
