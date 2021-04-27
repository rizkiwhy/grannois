<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
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
        $user = User::whereNotNull('email_verified_at')->get();
        return [
            'id' => Str::uuid(),
            'user_id' => $user
        ];
    }
}
