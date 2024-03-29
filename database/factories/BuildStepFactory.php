<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\BuildProfile;
use App\Models\BuildStep;
use App\Models\User;

class BuildStepFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BuildStep::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'task' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'description' => $this->faker->text(),
            'status' => $this->faker->word(),
            'build_profile_id' => BuildProfile::factory(),
            'owner_id' => User::factory(),
        ];
    }
}
