<?php

namespace App\Services\Api;

use App\Contracts\Api\CrudInterface;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\BaseResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class ProductService implements CrudInterface
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        return ProductResource::collection(
            Product::latest('id')
                ->with('categories')
                ->paginate(config('app.pagination_per_page'))
        )->response();
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function create(array $data): JsonResponse
    {
        $product = new Product();
        $product->fill($data);
        $product->save();
        if (isset($data[Product::CATEGORIES_KEY])
            && is_array($data[Product::CATEGORIES_KEY])
            && !empty($data[Product::CATEGORIES_KEY])) {
            $product->categories()->attach($data['categories']);
        }
        $product->load('categories');

        return (new ProductResource($product))->response();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $product = Product::with('categories')->findOrFail($id);

        return (new ProductResource($product))->response();
    }

    /**
     * @param array $data
     * @param int $id
     * @return JsonResponse
     */
    public function update(array $data, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->fill($data);
        $product->save();
        if (isset($data[Product::CATEGORIES_KEY])
            && is_array($data[Product::CATEGORIES_KEY])
            && !empty($data[Product::CATEGORIES_KEY])) {
            $product->categories()->sync($data['categories']);
        }
        $product->load('categories');

        return (new ProductResource($product))->response();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

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
                'id' => ['integer', 'exists:products,id'],
                'title' => ['nullable', 'string', 'between:3,12'],
                Product::CATEGORIES_KEY => ['nullable', 'array'],
                Product::CATEGORIES_KEY.'.*' => ['integer', 'exists:categories,id'],
                'price' => ['nullable', 'numeric', 'between:0,200'],
            ]);
        } else {
            $validation = Validator::make($data, [
                'title' => ['required', 'string', 'between:3,12'],
                Product::CATEGORIES_KEY => ['required', 'array'],
                Product::CATEGORIES_KEY.'.*' => ['integer', 'exists:categories,id'],
                'price' => ['required', 'numeric', 'between:0,200'],
            ]);
        }

        return $validation;
    }
}
