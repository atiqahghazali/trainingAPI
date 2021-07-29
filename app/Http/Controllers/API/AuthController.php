<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Validator;
use App\User;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;

    public function login(Request $request)
    {
        //login

        //if success
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // The user is active, not suspended, and exists.
            $token = auth()->user()->createToken('API')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'Successfully log in !',
                'token' => $token,
                'data' => auth()->user()
            ]);
        }else{
            //return wrong credential
            return response()->json([
                'success' => false,
                'message' => 'Please check your credentials'
            ]);
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to your email.', 'status' => true], 201)
            : response()->json(['message' => 'Unable to send reset link', 'status' => false], 401);
    }
}
