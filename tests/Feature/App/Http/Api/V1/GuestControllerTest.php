<?php

namespace Tests\Feature\App\Http\Api\V1;

use App\Models\Guest;
use App\Traits\CodeCountryFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @see GuestController
 */
#[Group('GuestController')]
final class GuestControllerTest extends TestCase
{
    use RefreshDatabase;
    use CodeCountryFaker;

    /**
     * Успешное создание.
     */
    public function testStoreSuccess(): void
    {
        $countryCode = collect(self::COUNTRY_CODES)->random();
        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->optional()->safeEmail,
            'phone' => $countryCode . " " . fake()->numerify('##########'),
            'country' => fake()->optional()->country,
        ];

        $response = $this->post(route('guests.store'), $data, headers: ['Accept' => 'application/json']);

        $response->assertJsonStructure(['first_name', 'last_name', 'email', 'phone', 'country']);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Успешное обновление.
     */
    public function testUpdateSuccess(): void
    {
        /** @var Guest $guest */
        $guest = Guest::factory()->create();
        $countryCode = collect(self::COUNTRY_CODES)->random();
        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->optional()->safeEmail,
            'phone' => $countryCode . " " . fake()->numerify('##########'),
            'country' => fake()->optional()->country,
        ];

        $response = $this->put(route('guests.update', $guest->id), $data);

        $response->assertJsonStructure(['first_name', 'last_name', 'email', 'phone', 'country']);
        $response->assertOk();
    }

    /**
     * Успешное получение.
     */
    public function testShowSuccess(): void
    {
        /** @var Guest $guest */
        $guest = Guest::factory()->create();

        $response = $this->get(route('guests.show', $guest->id));

        $response->assertJsonStructure(['first_name', 'last_name', 'email', 'phone', 'country']);
        $response->assertOk();
    }

    /**
     * Успешное удаление.
     */
    public function testDeleteSuccess(): void
    {
        /** @var Guest $guest */
        $guest = Guest::factory()->create();

        $response = $this->delete(route('guests.destroy', $guest));

        $response->assertOk();
    }
}
