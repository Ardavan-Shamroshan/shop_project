<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'     => $this->name,
            'category' => $this->whenLoaded('category'),
            'brand'    => $this->whenLoaded('brand'),
            'slug'     => $this->slug,
            'price'    => $this->price,
        ];
    }
}
