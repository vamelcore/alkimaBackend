<?php

namespace App\Contracts\Api;

use Illuminate\Http\JsonResponse;

interface CrudInterface
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function create(array $data): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse;

    /**
     * @param array $data
     * @param int $id
     * @return JsonResponse
     */
    public function update(array $data, int $id): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse;

    /**
     * @param array $data
     * @return mixed
     */
    public function validate(array $data);
}
