<?php

namespace App\Contracts\Api;

use App\Http\Requests\Api\ProductCreateRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use Illuminate\Http\JsonResponse;

interface ProductInterface
{
    public function list(): JsonResponse;
    public function create(ProductCreateRequest $request): JsonResponse;
    public function show(int $id): JsonResponse;
    public function update(ProductUpdateRequest $request, int $id): JsonResponse;
    public function destroy(int $id): JsonResponse;
}
