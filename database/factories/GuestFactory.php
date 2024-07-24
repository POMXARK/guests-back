<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Traits\CodeCountryFaker;

/**
 * @extends Factory<\App\Models\Guest>
 */
final class GuestFactory extends Factory
{
    use CodeCountryFaker;

    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Guest::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        $countryCode = collect(self::COUNTRY_CODES)->random();

        return [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->optional()->safeEmail,
            'phone' => $countryCode . " " . fake()->numerify('##########'),
            'country' => fake()->optional()->country,
        ];
    }
}
