<?php

namespace App\Services\Api;

use App\Contracts\Api\CategoryInterface;
use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\BaseResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryService implements CategoryInterface
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return CategoryResource::collection(
            Category::latest('id')
                ->paginate(config('app.pagination_per_page'))
        )->response();
    }

    /**
     * @param CategoryCreateRequest $request
     * @return JsonResponse
     */
    public function create(CategoryCreateRequest $request): JsonResponse
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return (new CategoryResource($category))->response();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);

        return (new CategoryResource($category))->response();
    }

    /**
     * @param CategoryUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->fill($request->all());
        $category->save();

        return (new CategoryResource($category))->response();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->products()->detach();
        $category->delete();

        return (new BaseResource([
            'message' => 'Deleted'
        ]))->response();
    }
}
