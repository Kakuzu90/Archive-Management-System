<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "book_id" => 1,
            "user_id" => rand(2, 5),
            "rate" => rand(1, 5),
            "comment" => $this->faker->sentence,
        ];
    }
}
