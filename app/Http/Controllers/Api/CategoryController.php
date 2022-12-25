<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\BaseResource;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function index()
    {
        return CategoryResource::collection(
            Category::latest('id')
                ->paginate(config('app.pagination_per_page'))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(CategoryCreateRequest $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(int $id)
    {
        $category = Category::findOrFail($id);

        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(CategoryUpdateRequest $request, int $id)
    {
        $category = Category::findOrFail($id);
        $category->fill($request->all());
        $category->save();

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        $category->products()->detach();
        $category->delete();

        return new BaseResource([
            'message' => 'Deleted'
        ]);
    }
}
