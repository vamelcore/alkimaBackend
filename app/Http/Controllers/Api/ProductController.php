<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductCreateRequest;
use App\Http\Requests\Api\ProductUpdateRequest;
use App\Services\Api\ProductService;
use OpenApi\Annotations as OA;

class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    public $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Get(
     * path="/products",
     * operationId="productsList",
     * tags={"Products"},
     * summary="Get products list",
     * description="Get products list",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ProductResource"))
     *         )
     *     ),
     * )
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
    /**
     * @OA\Post(
     * path="/products",
     * operationId="productCreate",
     * tags={"Products"},
     * summary="Create new product",
     * description="Create new product",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title","price", "categories[]"},
     *               @OA\Property(property="title", type="string", description="Product title"),
     *               @OA\Property(property="price", type="number", description="Product price"),
     *               @OA\Property(property="categories[]", type="array", @OA\Items(type="number")),
     *            ),
     *        ),
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", description="Product title"),
     *                 @OA\Property(property="price", type="number", description="Product price"),
     *                 @OA\Property(property="categories[]", type="array", @OA\Items(type="number")),
     *                 example={"title":"Title", "price":"100", "categories":{1,2}},
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/ProductResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     type="array",
     *                     @OA\Items(type="string"),
     *                     example={"The title field is required."}
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();

        return $this->service->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Get(
     * path="/products/{id}",
     * operationId="productShow",
     * tags={"Products"},
     * summary="Get product",
     * description="Get product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ProductId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ProductResource"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data not found"),
     *         )
     *     )
     * )
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
    /**
     * @OA\Put(
     * path="/products/{id}",
     * operationId="productUpdate",
     * tags={"Products"},
     * summary="Update product",
     * description="Update product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ProductId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *               type="object",
     *               required={"title","price", "categories[]"},
     *               @OA\Property(property="title", type="string", description="Product title"),
     *               @OA\Property(property="price", type="number", description="Product price"),
     *               @OA\Property(property="categories[]", type="array", @OA\Items(type="number")),
     *            ),
     *        ),
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", description="Product title"),
     *                 @OA\Property(property="price", type="number", description="Product price"),
     *                 @OA\Property(property="categories[]", type="array", @OA\Items(type="number")),
     *                 example={"title":"Title", "price":"100", "categories":{1,2}},
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/ProductResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data not found"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     type="array",
     *                     @OA\Items(type="string"),
     *                     example={"The title field is required."}
     *                 ),
     *             )
     *         )
     *     )
     * )
     */
    public function update(ProductUpdateRequest $request, int $id)
    {
        $data = $request->all();

        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Delete(
     * path="/products/{id}",
     * operationId="productDelete",
     * tags={"Products"},
     * summary="Delete product",
     * description="Delete product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ProductId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(type="string", example="deleted", description="User identifier", property="message"),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Data not found"),
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
