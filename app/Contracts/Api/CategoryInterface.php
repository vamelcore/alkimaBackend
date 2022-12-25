<?php

namespace App\Contracts\Api;

use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use Illuminate\Http\JsonResponse;

interface CategoryInterface
{
    public function list(): JsonResponse;
    public function create(CategoryCreateRequest $request): JsonResponse;
    public function show(int $id): JsonResponse;
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse;
    public function destroy(int $id): JsonResponse;
}
