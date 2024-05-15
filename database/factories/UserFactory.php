<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			"first_name" => $this->faker->firstName,
			"last_name" => $this->faker->lastName,
			"username" => $this->faker->userName,
			"password" => "password",
			"college_id" => rand(1, 6),
			"role_id" => rand(2, 4),
			"avatar" => rand(1, 7)
		];
	}
}
