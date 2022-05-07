<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Request $request){
        return view('profile', ['user' => (new UserResource(Auth::user()))->toArray($request)]);
    }
}
