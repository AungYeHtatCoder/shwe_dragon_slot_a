<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            "closing_balance" => $this->amountFloat + $this->meta['opening_balance'],
            "type" => $this->type,
            "amount" => $this->amountFloat,
            "datetime" => $this->created_at->format("Y-m-d H:i:s")
        ];
    }
}
