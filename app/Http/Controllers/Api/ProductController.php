<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductCreateRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\BaseResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return ProductResource::collection(
            Product::latest('id')
                ->with('categories')
                ->paginate(config('app.pagination_per_page'))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(ProductCreateRequest $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->save();
        $product->categories()->attach($request->get('categories'));
        $product->load('categories');

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(int $id)
    {
        $product = Product::with('categories')->findOrFail($id);

        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(ProductUpdateRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->fill($request->all());
        $product->save();
        $request->whenFilled('categories', function ($input) use ($product) {
            $product->categories()->sync($input);
        });
        $product->load('categories');

        return new ProductResource($product);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();

        return new BaseResource([
            'message' => 'Deleted'
        ]);
    }
}
