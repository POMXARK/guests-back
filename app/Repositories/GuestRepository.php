<?php

namespace App\Repositories;

use App\Models\Guest;
use Exception;
use Illuminate\Database\QueryException;

class GuestRepository implements GuestRepositoryInterface
{
    /**
     * Создание из массива.
     *
     * @throws QueryException
     */
    public function createFromArray(array $data): Guest
    {
        return Guest::query()->create($data);
    }

    /**
     * Поиск модели по идентификатору.
     *
     * @throws QueryException
     */
    public function findById(string $id)
    {
        /** @var Guest $stmt */
        return Guest::query()->find($id);
    }

    /**
     * Обновление из массива.
     *
     * @throws QueryException
     */
    public function updateFromArray(Guest $guest, array $data): Guest
    {
        $guest->update($data);

        return $guest;
    }

    /**
     * Удаление модели.
     *
     * @throws Exception
     */
    public function delete(Guest $guest): void
    {
        $guest->delete();
    }
}
