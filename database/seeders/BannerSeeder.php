<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 4; $i++){
            Banner::create([
                'name'  => $i+1,
                'show_in' => 'home',
                'image' => ($i+1).".jpg",
            ]);
        }
    }
}
