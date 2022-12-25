<?php

namespace App\Services\Api;

use App\Contracts\Api\ProductInterface;
use App\Http\Requests\Api\ProductCreateRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\BaseResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductService implements ProductInterface
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
     * @param ProductCreateRequest $request
     * @return JsonResponse
     */
    public function create(ProductCreateRequest $request): JsonResponse
    {
        $product = new Product();
        $product->fill($request->all());
        $product->save();
        $product->categories()->attach($request->get('categories'));
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
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        $product->save();
        $request->whenFilled('categories', function ($input) use ($product) {
            $product->categories()->sync($input);
        });
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
}
