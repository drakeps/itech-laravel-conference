<?php

namespace Database\Factories;

use App\Models\Conference;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'conference_id' => Conference::factory(),
            'name'          => $this->faker->firstName(),
            'email'         => $this->faker->email,
            'unit'          => $this->faker->company,
        ];
    }
}
