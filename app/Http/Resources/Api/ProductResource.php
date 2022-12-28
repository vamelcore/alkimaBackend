<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     title="Product",
 *     description="API product item",
 *     @OA\Xml(
 *         name="ProductResource"
 *     )
 * )
 */
class ProductResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    /**
     * @OA\Property(type="integer", example="1", description="Identifier", property="id"),
     * @OA\Property(type="string", example="Title", description="Product title", property="title"),
     * @OA\Property(type="number", example="100.55", description="Product price", property="price"),
     * @OA\Property(property="categories", type="array", @OA\Items(ref="#/components/schemas/CategoryResource")),
     * @OA\Property(type="string", format="date-time", example="2022-12-25T10:47:23.000000Z", description="Create date", property="created_at"),
     * @OA\Property(type="string", format="date-time", example="2022-12-25T10:47:23.000000Z", description="Update date", property="updated_at")
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
