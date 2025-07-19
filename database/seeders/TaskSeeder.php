<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $userIds = User::pluck('id'); 

        if ($userIds->isEmpty()) {
            $this->command->warn('No users found. Please run the UserSeeder first.');
            return;
        }

        foreach (range(1, 10) as $i) {
            Task::create([
                'title' => $faker->sentence(3),
                'description' => $faker->text(100),
                'due_date' => optional($faker->optional()->dateTimeBetween('+1 days', '+1 month'))->format('Y-m-d'),
                'is_completed' => $faker->boolean(50),
                'user_id' => $faker->randomElement($userIds), 
            ]);
        }
    }
}
