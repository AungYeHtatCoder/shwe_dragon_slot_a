<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>  $this->id,
            'game_id' =>  $this->game_id,
            'name'=> $this->name_en,
            'image' => $this->image_url,
            'click_count'=> $this->click_count,
            'game_type_id'=> $this->game_type_id,
            'product_id'=> $this->product_id
        ];
    }
}
