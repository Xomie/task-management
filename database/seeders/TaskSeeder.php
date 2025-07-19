<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $i) {
            Task::create([
                'title' => $faker->sentence(3),
                'description' => $faker->text(100),
                'due_date' => optional($faker->optional()->dateTimeBetween('+1 days', '+1 month'))->format('Y-m-d'),
                'is_completed' => $faker->boolean(50),
            ]);
        }
    }
}
