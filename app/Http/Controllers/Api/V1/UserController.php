<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function show(Request $request)
    {
        return $this->success(data: new  UserResource(Auth::user()));
    }

    public function logout(Request $request)
    {
        try {

            JWTAuth::unsetToken();

            return $this->success();

        } catch (JWTException $exception) {
            return $this->failed();
        }
    }
}