<?php

namespace App\Http\Resources;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CartItem
 */
class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'product' => ListProductResource::make($this->product),
            'quantity' => $this->quantity,
            'price_item' => $this->price_item,
            'price_total' => $this->price_total,
        ];
    }
}
