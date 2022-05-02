<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\AppealFormRequest;
use App\Models\Appeal;
use App\Sanitizer\PhoneSanitizer;
use Illuminate\Http\JsonResponse;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

class AppealController extends Controller
{
    public function send(AppealFormRequest $request)
    {
        $data = $request->validated();

        $appeal = new Appeal();
        $appeal->name = $data['name'];
        $appeal->phone = $data['phone'] ?? null ? PhoneSanitizer::sanitize($data['phone']) : null;
        $appeal->email = $data['email'] ?? null;
        $appeal->message = $data['message'];
        $appeal->save();

        return response()->json([
            'message' => 'Appeal successfully sent'
        ]);
    }

    public function form()
    {
        return view('appeal',['success'=>session('success',false)]);
    }
}
