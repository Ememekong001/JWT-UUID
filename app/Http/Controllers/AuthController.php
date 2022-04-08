<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\ResetRequest;
use Illuminate\Http\Request;
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

    public function resetPasswordRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

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


    public function resetPassword(ResetRequest $request)
    {
        try {
            $newPassword = $request['password'];
            //Validate the token
            $tokenData = DB::table('password_resets')
            ->where('token', $request['token'])->first();
            if (!$tokenData)
            return $this->sendError('Token not found', 404);

            //Redirect the user back if the email is invalid
            $user = User::where('email', $tokenData->email)->first();
            if (!$user) return $this->sendError('Email not found', 404);

            //Hash and update new password
            $user->password = Hash::make($newPassword);
            $user->update();

            //Delete the Token because user will not reuse the token.
            DB::table('password_resets')->where('email', $user->email)->delete();

            //Send a password reset success Email
            $mail= Mail::send('Email.resetPasswordSuccess', [], function ($message) use ($request) {
                $message->to($request['email']);
                $message->subject('Reset Password Successful');
                $message->from('admin@example.com');
            });
            return $this->sendReply($mail, 'Password set successfully. Login to access profile.');

        } catch (\Exception $e) {
            return $this->sendError($e->getmessage(), 422);
        }
    }
}

