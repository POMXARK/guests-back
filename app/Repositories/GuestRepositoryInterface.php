<?php

namespace App\Repositories;

use App\Models\Guest;
use Exception;
use Illuminate\Database\QueryException;

/**
 * Интерфейс репозитория гостей.
 */
interface GuestRepositoryInterface
{
    /**
     * Создание из массива.
     *
     * @throws QueryException
     */
    public function createFromArray(array $data): Guest;

    /**
     * Поиск модели по идентификатору.
     *
     * @throws QueryException
     */
    public function findById(string $id);

    /**
     * Обновление из массива.
     *
     * @throws QueryException
     */
    public function updateFromArray(Guest $guest, array $data): Guest;

    /**
     * Удаление модели.
     *
     * @throws Exception
     */
    public function delete(Guest $guest): void;
}
