<?php

namespace App\Http\Resources;

use App\Enums\DeliveryType;
use App\Enums\PaymentMethod;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result = [
            'customer_name' => $this->customer_name,
            'customer_email' => $this->customer_email,
            'payment_method' => PaymentMethod::keyByValue($this->payment_method),
            'delivery_type' => DeliveryType::keyByValue($this->delivery_type),
            'cart' => CartResource::make($this->cart),
        ];
        $address = $this->address;
        if ($address !== null) {
            $result += [
                'address' => [
                    'city' => $address->city,
                    'street' => $address->street,
                    'house' => $address->house,
                    'apartment' => $address->apartment,
                ]
            ];
        }
        return $result;
    }
}
