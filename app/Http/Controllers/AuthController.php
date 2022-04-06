<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            $user->role_id = '7';
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
        try
        {
            if (!$token = JWTAuth::attempt($credentials))
            {
                return $this->sendError('Invalid Credentials.', ['error'=>'Unauthorised'], 401);
            }
        }
        catch (JWTException $e)        {
            return $this->sendError($e->getmessage(), 422);

        }
        return $this->respondWithToken($token);


    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function resetPasswordRequest(ResetRequest $request)
    {
        //checking if email exists on db
        $user = User::where('email', $request['email'])->first();
        if (!$user) {
            return $this->sendError('Email not registered', 404);
        }else
        {
            try
            {
                //creating a new token
                DB::table('password_resets')->insert
                ([
                    'email' => $request->email,
                    'token' => Str::random(64),
                    'created_at' => Carbon::now()
                ]);

                $tokenData = DB::table('password_resets')->where('email', $request['email'])->first();
                $token =$tokenData->token;

                $resetlink = url('/reset_password/'.$token) ;
                //send mail
                $mail = Mail::send('Email.resetPassword', ['token' => $token, 'link' =>$resetlink], function($message) use ($request) {
                    $message->from('admin@example.com');
                    $message->to($request['email']);
                    $message->subject('Reset Password Notification');
                });
                return $this->sendReply($mail, 'Token sent, check your email.');
            }catch (JWTException $e)
            {
                return $this->sendError($e->getmessage(), 422);
            }
        }
    }

    public function getPassword($token)
    {
        return view('auth.reset_password',[ 'token' =>$token]);
    }

    // public function resetPassword($request)
    // {
    //     try {
    //         $newPassword = $request['new_password'];
    //     //Validate the token
    //         $tokenData = DB::table('password_resets')
    //             ->where('token', $request['token'])->first();
    //         if (!$tokenData) return $this->sendError('Token not found', 404);

    //         $user = User::where('email', $tokenData->email)->first();
    //         //Redirect the user back if the email is invalid
    //         if (!$user) return $this->sendError('Email not found', 404);

    //         //Hash and update new password
    //         $user->password = Hash::make($newPassword);
    //         $user->save();

    //         //Delete the Token
    //         DB::table('password_resets')->where('email', $user->email)->delete();

    //         //Send a password reset success Email
    //         Mail::send('Email.resetPasswordSuccess', [], function ($message) use ($tokenData) {
    //             $message->to($tokenData['email']);
    //             $message->subject('Reset Password Successful');
    //             $message->from('admin@example.com');
    //         });
    //     } catch (\Exception $e) {
    //         return $this->sendError($e->getmessage(), 422);
    //     }
    // }
}

