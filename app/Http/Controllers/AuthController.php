<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends BaseController
{
    public function signUp(RegisterRequest $request)
    {
        try {
            $data = $request->validated();

            $user = new User();
            $user->name = $data['name'];
            $user->user_id = $this->generateUuid();
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->phone = $data['phone'];
            $user->age = $data['age'];
            $user->address = $data['address'];
            $user->save();
            return $this->sendReply($user, 'User sign up was successful.');


        }
        catch (JWTException $e)
        {
            return $this->sendError($e->getmessage(), 422);
        }
    }

    public function signIn(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth()->attempt($credentials))
            {
                return $this->sendError('Invalid Credentials.', ['error'=>'Unauthorised'], 401);
            }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }



}
