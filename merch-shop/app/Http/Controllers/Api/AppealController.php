<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppealApiRequest;
use App\Models\Appeal;
use App\OpenApi\Parameters\AppealParameters;
use App\OpenApi\Responses\AppealFailedResponse;
use App\OpenApi\Responses\AppealSuccessResponse;
use App\Sanitizers\PhoneSanitizer;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AppealController extends Controller
{
    /**
     * Send params to make appeal form.
     *
     * @param AppealApiRequest $request
     * @return JsonResponse
     */
    #[OpenApi\Operation(tags: ['appeal'], method: 'post')]
    #[OpenApi\Response(factory: AppealSuccessResponse::class, statusCode: 200)]
    #[OpenApi\Response(factory: AppealFailedResponse::class, statusCode: 422)]
    #[OpenApi\Parameters(factory: AppealParameters::class)]
    public function send(AppealApiRequest $request): JsonResponse
    {
        $data = $request->validated();

        $appeal = new Appeal();
        $appeal->name = $data['name'];
        $appeal->phone = PhoneSanitizer::sanitize($data['phone'] ?? null);
        $appeal->email = $data['email'] ?? null;
        $appeal->message = $data['message'];
        $appeal->save();

        return response()->json([
            'message' => 'Appeal successfully sent'
        ]);
    }
}
