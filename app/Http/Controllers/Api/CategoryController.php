<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryCreateRequest;
use App\Http\Requests\Api\CategoryUpdateRequest;
use App\Services\Api\CategoryService;
use OpenApi\Annotations as OA;

class CategoryController extends Controller
{
    /**
     * @var CategoryService
     */
    public $service;

    public function __construct()
    {
        $this->service = new CategoryService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @OA\Get(
     * path="/categories",
     * operationId="categoriesList",
     * tags={"Categories"},
     * summary="Get category list",
     * description="Get category list",
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page",
     *         required=false,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/CategoryResource"))
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
     * path="/categories",
     * operationId="categoryCreate",
     * tags={"Categories"},
     * summary="Create new category",
     * description="Create new category",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"title"},
     *               @OA\Property(property="title", type="string"),
     *            ),
     *        ),
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", description="Category title"),
     *                 example={"title":"Title"},
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/CategoryResource")
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
    public function store(CategoryCreateRequest $request)
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
     * path="/categories/{id}",
     * operationId="categoryShow",
     * tags={"Categories"},
     * summary="Get category",
     * description="Get category",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="CategoruId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/CategoryResource"))
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
     * path="/categories/{id}",
     * operationId="categiryUpdate",
     * tags={"Categories"},
     * summary="Update category",
     * description="Update category",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="CategoruId",
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
     *               required={"title"},
     *               @OA\Property(property="title", type="string"),
     *            ),
     *        ),
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(property="title", type="string", description="Category title"),
     *                 example={"title":"Title"},
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object", ref="#/components/schemas/CategoryResource")
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
    public function update(CategoryUpdateRequest $request, int $id)
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
     * path="/categories/{id}",
     * operationId="categoryDelete",
     * tags={"Categories"},
     * summary="Delete category",
     * description="Delete category",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="CategoruId",
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
     *                 @OA\Property(type="stringr", example="deleted", description="User identifier", property="message"),
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
    public function destroy(int $id)
    {
        return $this->service->destroy($id);
    }
}
