<?php

namespace Database\Factories;

use App\Models\TransportRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
// use \App\Models\User;

class TransportRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransportRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           
            'user_id'=> \App\Models\User::factory(),
            'name'=>$this->faker->name(),
            'seen'=>$this->faker->boolean(),
            'cell'=>$this->faker->word(),
            'no_of_People'=>$this->faker->numberBetween(1,9),
            'destination'=>$this->faker->paragraph,
            'departure_date'=>$this->faker->date,
            'departure_time'=>$this->faker->time,
            'return_date'=>$this->faker->date,
            'return_time'=>$this->faker->boolean(),
        ];
    }
}
