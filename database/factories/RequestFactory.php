<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RequestFactory extends Factory
{
    protected $model = Request::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'ip_address' => $this->faker->ipv4(),
            'path' => $this->faker->word(),
            'method' => $this->faker->word(),
            'content_type' => $this->faker->word(),
            'query_string' => $this->faker->word(),
            'body' => $this->faker->word(),
            'user_agent' => $this->faker->word(),

            'user_id' => User::factory(),
            'project_id' => Project::factory(),
        ];
    }
}
