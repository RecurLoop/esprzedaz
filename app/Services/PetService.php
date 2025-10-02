<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetService
{
    private string $apiUrl = 'https://petstore.swagger.io/v2/pet';

    public function getAll(string $status = 'available'): array
    {
        $response = Http::get($this->apiUrl . '/findByStatus', ['status' => $status]);
        return $response->ok() ? $response->json() : [];
    }

    public function getById(int $id): ?array
    {
        $response = Http::get($this->apiUrl . '/' . $id);
        return $response->ok() ? $response->json() : null;
    }

    public function create(array $data): bool
    {
        $response = Http::post($this->apiUrl, $data);
        return $response->ok();
    }

    public function update(int $id, array $data): bool
    {
        $payload = array_merge(['id' => $id], $data);
        $response = Http::put($this->apiUrl, $payload);
        return $response->ok();
    }

    public function delete(int $id): bool
    {
        $response = Http::delete($this->apiUrl . '/' . $id);
        return $response->ok();
    }
}
