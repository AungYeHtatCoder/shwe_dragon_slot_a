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
            'code' =>  $this->code,
            'name'=> $this->name,
            'click_count'=> $this->click_count,
            'game_type_id'=> $this->game_type_id,
            'product_id'=> $this->product_id,
            'image_url' => $this->image_url

            //'game_id' =>  $this->game_id,
        ];
    }
}