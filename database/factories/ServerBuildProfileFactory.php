<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BuildProfile;
use App\Models\Server;
use App\Models\ServerBuildProfile;
use App\Models\User;

class ServerBuildProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServerBuildProfile::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->word(),
            'server_id' => Server::factory(),
            'build_profile_id' => BuildProfile::factory(),
            'owner_id' => User::factory(),
        ];
    }
}
