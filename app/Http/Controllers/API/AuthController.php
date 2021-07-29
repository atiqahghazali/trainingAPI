<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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
}
