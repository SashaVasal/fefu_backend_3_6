<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartModificationRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\OpenApi\Responses\ShowCartResponse;
use Auth;
use Illuminate\Http\Request;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class CartController extends Controller
{
    /**
     * Return cart by user or session
     * @param CartModificationRequest $request
     * @return CartResource
     */
    #[OpenApi\Operation(tags: ['cart'], method: 'GET')]
    #[OpenApi\Response(factory: ShowCartResponse::class, statusCode: 200)]
    public function show(): CartResource
    {
        $user = Auth::user();
        $sessionId = session()->getId();
        $cart = Cart::getOrCreateCart($user, $sessionId);
        return CartResource::make($cart);
    }
    /**
     * Add products to cart and set quantity
     *
     * @param CartModificationRequest $request
     * @return CartResource
     */
    #[OpenApi\Operation(tags: ['cart'], method: 'POST')]
    #[OpenApi\Response(factory: ShowCartResponse::class, statusCode: 200)]
    public function setQuantity(CartModificationRequest $request): CartResource
    {
        $data = $request->validated();
        $user = Auth::user();

        $sessionId = session()->getId();
        $cart = Cart::getOrCreateCart($user, $sessionId);

        $productsById = Product::whereIn('id', array_column($data, 'product_id'))->get()->keyBy('id');
        foreach ($data as $i) {
            $cart->setProductQuantity($productsById[$i['product_id']], $i['quantity']);
        }
        $cart->recalculateCart();
        $cart->save();

        return CartResource::make($cart);
    }
}
