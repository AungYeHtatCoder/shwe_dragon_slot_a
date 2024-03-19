<?php

namespace App\Http\Resources;

use App\Enums\WagerStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $amount = $this->transactions->sum("transaction_amount");

        return [
            "id" => $this->id,
            "status" => $amount > 0 ? WagerStatus::Win : WagerStatus::Lose,
            "amount" => $this->transactions->sum("transaction_amount"),
            "datetime" => $this->created_at->format("Y-m-d H:i:s")
        ];
    }
}
