<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Pizza extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ingredients = $this->ingredients()->get();
        $cost = 0;
        foreach ($ingredients as $ingredient) {
            $cost += $ingredient->price;
        }
        $price = $cost*1.5; #costo mas ganacia 50%


        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image,
            'price' => $price,
            'ingredients' => $ingredients->toArray(request())
            ];
    }
}
