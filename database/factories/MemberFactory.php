<?php

namespace Database\Factories;

use App\Models\Conference;
use App\Models\Lecture;
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
            'lecture_id'    => Lecture::factory(),
            'firstname'     => $this->faker->firstName(),
            'lastname'      => $this->faker->lastName(),
            'email'         => $this->faker->email,
            'unit'          => $this->faker->company,
        ];
    }
}
