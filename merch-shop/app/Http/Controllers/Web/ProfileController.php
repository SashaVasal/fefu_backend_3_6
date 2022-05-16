<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request){
        return view('profile',['user' => (new UserResource(Auth::user()))->toArray($request)]);
    }
}
