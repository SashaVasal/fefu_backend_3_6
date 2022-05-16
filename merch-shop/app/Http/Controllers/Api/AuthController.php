<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseLoginFormRequest;
use App\Http\Requests\BaseRegisterFormRequest;
use App\Models\User;
use App\OpenApi\Parameters\RegisterParameters;
use Illuminate\Http\JsonResponse;
use App\OpenApi\Parameters\loginParameters;
use App\OpenApi\Responses\LoginErrorResponse;
use App\OpenApi\Responses\LoginSuccessfullyResponse;
use App\OpenApi\Responses\LogoutErrorResponse;
use App\OpenApi\Responses\LogoutSuccessfullyResponse;
use App\OpenApi\Responses\RegisterErrorResponse;
use App\OpenApi\Responses\RegisterSuccessfullyResponse;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use Illuminate\Http\Request;


#[OpenApi\PathItem]
class AuthController extends Controller
{
    /**
     * Login.
     *
     * @param BaseLoginFormRequest $request
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Parameters(factory:loginParameters::class)]
    #[OpenApi\Response(factory:LoginErrorResponse::class,statusCode:422)]
    #[OpenApi\Response(factory:LoginSuccessfullyResponse::class,statusCode:200)]
    public function login(BaseLoginFormRequest $request):JsonResponse
    {
        $data = $request->validated();

        if(Auth::attempt($data, true)){
            $request->session()->regenerate();

            return response()->json([], 200);
        }
        return response()->json(['errors' => ['' => 'The provided credentials are incorrect.']], 422);
    }

    /**
     * Logout.
     *
     * @param Request $request
     * @return JsonResponse
     */

    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Response(factory: LogoutSuccessfullyResponse::class,statusCode: 200)]
    #[OpenApi\Response(factory: LogoutErrorResponse::class,statusCode: 422)]
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([], 200);
    }


    /**
     * Register.
     *
     * @param RegisterFormRequest $request
     * @return JsonResponse
     */

    #[OpenApi\Operation(tags: ['auth'], method: 'POST')]
    #[OpenApi\Parameters(factory:RegisterParameters::class)]
    #[OpenApi\Response(factory: RegisterSuccessfullyResponse::class,statusCode: 200)]
    #[OpenApi\Response(factory: RegisterErrorResponse::class,statusCode: 422)]
    public function register(BaseRegisterFormRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::createFromRequest($data);
        Auth::login($user);
        return response()->json([], 200);
    }


}

