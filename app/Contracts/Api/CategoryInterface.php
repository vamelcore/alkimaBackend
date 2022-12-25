<?php

namespace App\Contracts\Api;

use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use Illuminate\Http\JsonResponse;

interface CategoryInterface
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse;

    /**
     * @param CategoryCreateRequest $request
     * @return JsonResponse
     */
    public function create(CategoryCreateRequest $request): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse;

    /**
     * @param CategoryUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse;
}
