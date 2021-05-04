<?php

namespace Database\Factories;

use App\Models\Images;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{

    protected $model = Images::class;


    public function definition()
    {
        return [
            'name' => $this->faker->numberBetween(1,6).'.png',
        ];
    }
}
