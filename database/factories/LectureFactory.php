<?php

namespace Database\Factories;

use App\Models\Conference;
use App\Models\Lecture;
use App\Models\Member;
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
            'member_id'     => Member::factory(),
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

    public function rejected()
    {
        return $this->state(function () {
            return [
                'accepted' => false,
            ];
        });
    }

    public function withoutEvents()
    {
        $this->modelName()::flushEventListeners();

        return $this;
    }
}
