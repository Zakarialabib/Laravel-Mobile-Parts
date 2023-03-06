<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

final class PhoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status'=>$this->faker->boolean(),
        ];
    }
}
