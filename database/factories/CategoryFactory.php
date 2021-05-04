<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type=['single','as a product'];
        $name_en=$this->faker->word;
        return [
            'name_ar' => $this->faker->word,
            'name_en' => ucfirst($name_en) ,
            'slug' => $name_en,
            'image' => 'avatar-'.$this->faker->numberBetween(1,10).'.jpg',
            'type' => $type[array_rand($type)],
        ];
    }
}
