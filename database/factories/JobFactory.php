<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          "user_id" => 1,
          "customer_id" => 1,
          "state" => "New"
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
              'state' => "Completed"
            ];
        });
    }
}
