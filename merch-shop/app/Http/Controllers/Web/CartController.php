<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function __invoke(Request $request): View|Factory|Application
    {
        $user = Auth::user();
        $session_id = session()->getId();
        $cart = Cart::getOrCreateCart($user, $session_id);

        return view('cart', ['cart' => CartResource::make($cart)]);
    }
}
