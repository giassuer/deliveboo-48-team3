<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'path_img' => $this->path_img,
            'price' => $this->price,
            'visible' => $this->visible,
            'slug' => $this->slug,
            'restaurant_id' => $this->restaurant_id,

        ];
    }
}
