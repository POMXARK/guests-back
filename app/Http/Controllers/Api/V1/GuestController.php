<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Models\Guest;
use App\Services\Domains\GuestService;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GuestController extends Controller
{
    public function __construct(private readonly GuestService $guestService)
    {
    }

    /**
     * Создать гостя.
     */
    public function store(StoreGuestRequest $request): JsonResponse
    {
        return response()->json($this->guestService->create($request->validated()), Response::HTTP_CREATED);
    }

    /**
     * Получить данные гостя.
     */
    public function show(Guest $guest): JsonResponse
    {
        return response()->json($this->guestService->findById($guest->id));
    }

    /**
     * Обновить данные гостя.
     */
    public function update(UpdateGuestRequest $request, Guest $guest): JsonResponse
    {
        return  response()->json($this->guestService->update($guest, $request->validated()));
    }

    /**
     * Удалить гостя.
     *
     * @throws Exception
     */
    public function destroy(Guest $guest): JsonResponse
    {
        $this->guestService->delete($guest);

        return response()->json(['status' => true]);
    }
}
