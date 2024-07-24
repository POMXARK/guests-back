<?php

namespace App\Services\Domains;

use App\Models\Guest;
use App\Repositories\GuestRepositoryInterface;
use Exception;
use Nakanakaii\Countries\Countries;

/**
 * @see GuestServiceTest
 */
readonly class GuestService
{
    public function __construct(private GuestRepositoryInterface $guestRepository)
    {

    }

    /**
     * Создание гостя.
     * @throws Exception
     */
    public function create(array $data): Guest
    {
        return $this->guestRepository->createFromArray($this->getCountry($data));
    }

    /**
     * Получить данные гостя.
     */
    public function findById(string $id): Guest
    {
        return $this->guestRepository->findById($id);
    }

    /**
     * Обновить данные гостя.
     * @throws Exception
     */
    public function update(Guest $stmt, array $data): Guest
    {
        return $this->guestRepository->updateFromArray($stmt, $this->getCountry($data));
    }

    /**
     * Удалить гостя.
     *
     * @throws Exception
     */
    public function delete(Guest $stmt): void
    {
        $this->guestRepository->delete($stmt);
    }

    /**
     * Если страна не указана, то доставать страну из номера телефона.
     */
    public function getCountry(array $data): array
    {
        if (empty($data['country'])) {
            $countryCode = explode(" ", $data['phone'])[0];
            $data['country'] = Countries::findByDialCode($countryCode)['name'];
        }

        return $data;
    }
}
