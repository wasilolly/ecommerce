<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'Jane',
            'email' => 'jane@example.com',
            'password' => bcrypt('password')
        ]);

        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'admin' => 1,
            'password' => bcrypt('password')
        ]);

        \App\Models\Category::create([ 'name' => 'chocolate', 'slug' =>'chocolate', 'description'=> 'This is about chocolate']);
        \App\Models\Category::create([ 'name' => 'Vanilla', 'slug' =>'Vanilla', 'description'=> 'This is about vanilla']);
        \App\Models\Category::create([ 'name' => 'StrawBerry', 'slug' =>'strawberry', 'description'=> 'This is about strawberry']);
        \App\Models\Category::create([ 'name' => 'Rasberry', 'slug' =>'rasberry', 'description'=> 'This is about rasberry']);




    }
}
