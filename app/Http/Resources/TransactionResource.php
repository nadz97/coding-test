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
            'transaction' => [
                'order_id' => $this->order_id,
                'total_amount' => $this->total_amount,
                'status' => $this->status,
                'description' => $this->description,
                'expired_date' => $this->expired_date,
            ],
            'item' => $this->item,
            'customer' => $this->customer,
        ];
        // return [
        //     'total_amount' => $this->total_amount,
        //     'status' => $this->status
        // ];
    }
}
