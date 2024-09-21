<?php

namespace Database\Factories\Entities\Model;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = \Entities\Model\User::class;

    public function definition()
    {
        return [
            // Define your model's default state here.
            'name' => $this->faker->name,
        ];
    }
}
