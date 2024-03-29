<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BuildHistory;
use App\Models\ServerBuildProfile;

class BuildHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildHistory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'server_build_profile_id' => ServerBuildProfile::factory(),
            'response' => $this->faker->text(),
        ];
    }
}
