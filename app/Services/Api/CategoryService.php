<?php

namespace App\Services\Api;

use App\Contracts\Api\CategoryInterface;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\BaseResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

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
     * @param array $data
     * @return JsonResponse
     */
    public function create(array $data): JsonResponse
    {
        $category = new Category();
        $category->fill($data);
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
     * @param array $data
     * @param int $id
     * @return JsonResponse
     */
    public function update(array $data, int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        $category->fill($data);
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

    /**
     * @param array $data
     * @return mixed
     */
    public function validate(array $data)
    {
        if (isset($data['id']) && intval($data['id'])) {
            $validation = Validator::make($data, [
                'id' => ['integer', 'exists:categories,id'],
                'title' => ['nullable', 'string', 'between:3,12'],
            ]);
        } else {
            $validation = Validator::make($data, [
                'title' => ['required', 'string', 'between:3,12'],
            ]);
        }

        return $validation;
    }
}
