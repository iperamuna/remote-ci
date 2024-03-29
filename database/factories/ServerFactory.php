<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Environment;
use App\Models\Server;
use App\Models\User;

class ServerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Server::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'hostname' => $this->faker->word(),
            'ip' => $this->faker->word(),
            'port' => $this->faker->word(),
            'url' => $this->faker->url(),
            'pass_phrase' => $this->faker->word(),
            'pass_file' => $this->faker->word(),
            'username' => $this->faker->userName(),
            'status' => $this->faker->word(),
            'environment_id' => Environment::factory(),
            'owner_id' => User::factory(),
        ];
    }
}
