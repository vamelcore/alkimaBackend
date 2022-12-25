<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Api\CategoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * @var CategoryInterface
     */
    public $service;

    /**
     * @param CategoryInterface $service
     */
    public function __construct(CategoryInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->service->list();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryCreateRequest $request)
    {
        return $this->service->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CategoryUpdateRequest $request, int $id)
    {
        return $this->service->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}
