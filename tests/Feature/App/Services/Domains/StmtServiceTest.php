<?php

namespace Feature\App\Services\Domains;

use App\Models\Guest;
use App\Services\Domains\GuestService;
use App\Traits\CodeCountryFaker;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

/**
 * Тесты сервиса.
 *
 * @see GuestService
 */
#[Group('GuestService')]
final class StmtServiceTest extends TestCase
{
    use RefreshDatabase;
    use CodeCountryFaker;

    /**
     * Успешное создание.
     */
    public function testCreateSuccess(): void
    {
        $guestService = app(GuestService::class);
        $countryCode = collect(self::COUNTRY_CODES)->random();
        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->optional()->safeEmail,
            'phone' => $countryCode . " " . fake()->numerify('##########'),
            'country' => fake()->country,
        ];

        $guestService->create($data);

        $this->assertDatabaseHas('guests', $data);
    }

    /**
     * Успешно получить.
     */
    public function testFindByIdSuccess(): void
    {
        $guestService = app(GuestService::class);
        /** @var Guest $guest */
        $guest = Guest::factory()->create();

        $model = $guestService->findById($guest->id);

        $this->assertSame($model->id, $guest->id);
    }

    /**
     * Успешное обновление.
     */
    public function testUpdateSuccess(): void
    {
        $guestService = app(GuestService::class);
        $guest = Guest::factory()->create();
        $countryCode = collect(self::COUNTRY_CODES)->random();
        $data = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'email' => fake()->optional()->safeEmail,
            'phone' => $countryCode . " " . fake()->numerify('##########'),
            'country' => fake()->country,
        ];

        $guestService->update($guest, $data);

        $this->assertDatabaseHas('guests', $data);
    }

    /**
     * Успешное удаление.
     *
     * @throws Exception
     */
    public function testDeleteSuccess(): void
    {
        $guestService = app(GuestService::class);
        /** @var Guest $guest */
        $guest = Guest::factory()->create();

        $guestService->delete($guest);

        $this->assertSoftDeleted('guests', ['id' => $guest->id]);
    }
}
