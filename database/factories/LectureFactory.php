<?php

namespace Database\Factories;

use App\Models\Conference;
use App\Models\Lecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'conference_id' => Conference::factory(),
            'topic'         => $this->faker->sentence(),
            'description'   => $this->faker->sentence(),
        ];
    }

    public function accepted()
    {
        return $this->state(function () {
            return [
                'accepted' => true,
            ];
        });
    }
}
