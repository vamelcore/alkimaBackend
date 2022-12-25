<?php

namespace App\Contracts\Api;

use App\Http\Requests\Api\ProductCreateRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use Illuminate\Http\JsonResponse;

interface ProductInterface
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse;

    /**
     * @param ProductCreateRequest $request
     * @return JsonResponse
     */
    public function create(ProductCreateRequest $request): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse;

    /**
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse;

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse;
}
