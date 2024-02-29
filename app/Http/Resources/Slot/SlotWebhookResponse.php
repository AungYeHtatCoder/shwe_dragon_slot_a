<?php

namespace App\Http\Resources\Slot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotWebhookResponse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "ErrorCode" => $this->resource["ErrorCode"],
            "ErrorMessage" => $this->resource["ErrorMessage"],
            "Balance" => $this->resource["Balance"],
            "BeforeBalance" => $this->resource["BeforeBalance"]
        ];
    }
}
