<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'names' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'idType' => $this->faker->numberBetween(1,3),
            'idNumber' => $this->faker->numberBetween(1000,9999),
            'gender' => $this->faker->numberBetween(1,3),
            'dateOfBirth' => $this->faker->date(),
            'career' => $this->faker->text(20)
        ];
    }
}
