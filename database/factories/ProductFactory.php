<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    protected $model = Product::class;

    public function definition()
    {
        $type=['single','group'];
        $name_en=$this->faker->word;
        return [
            'name_ar'=>$this->faker->word,
            'name_en'=>ucfirst($name_en),
            'slug'=>$name_en,
            'description_ar'=>$this->faker->text(200),
            'description_en'=>$this->faker->text(200),
            'serial'=>$this->faker->unique()->randomNumber(4),
            'sku'=>$this->faker->randomNumber(4),
            'sale'=>$this->faker->randomNumber(3),
            'type'=>$type[array_rand($type)],
            'price'=>$this->faker->randomNumber(4),
            'stock'=>$this->faker->randomNumber(2),
            'image'=>'avatar-1.jpg',
        ];
    }
}
