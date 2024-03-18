<?php

namespace App\Http\Resources;

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
        return [
            "id" => $this->id,
            "status" => $this->status,
            "closing_balance" => $this->latestTransaction->transactions[0]->amountFloat + $this->latestTransaction->transactions[0]->meta['opening_balance'],
            "type" => $this->latestTransaction->transactions[0]->type,
            "amount" => $this->latestTransaction->transactions[0]->amountFloat,
            "datetime" => $this->created_at->format("Y-m-d H:i:s")
        ];
    }
}
