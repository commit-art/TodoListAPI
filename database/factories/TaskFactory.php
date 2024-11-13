<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()
                ->select('id')
                ->pluck('id')
                ->shuffle()
                ->first(),
            'title' => fake()->name(),
            'description' => fake()->text(1000),
            'priority' => fake()->randomElement(TaskPriority::cases()),
            'created_at' => fake()->dateTimeBetween('-1 years'),
            'completed_at' => fake()->randomElement([true, false]) ?
                fake()->dateTimeBetween('-1 years') : null
        ];
    }
}
