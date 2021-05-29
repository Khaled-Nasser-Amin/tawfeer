<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Images;
use App\Models\Product;
use App\Models\Review;
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
        // \App\Models\User::factory(10)->create();

        $this->call(UserSeeder::class);
        $this->call(BannerSeeder::class);
        Category::create([
            'name_ar' => 'انواع اخرى',
            'name_en' => 'Other cars',
            'slug' =>'other-cars',
            'image' => '1.jpg'
        ]);
        /*Category::factory()->has(
            Product::factory()->has(
                Images::factory()->count(4)
            )->count(5)
        )->count(10)->create();*/



    }
}
