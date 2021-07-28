<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $users = User::where('name','LIKE','%'.$request->search.'%')->paginate();
        }else{
            $users = User::paginate();
        }
        //query all users from DB using Model User.php
        
        //return to json
        return response()->json([
            'success' => true,
            'message' => 'Successsfully fetch all users',
            'data' => $users,
        ]);
    }

    public function store (Request $request)
    {
        // validation
        $request->validate([
            'name' => 'min:5',
            'email' => 'required|unique:users',
            'password' => 'min:5'
        ]);
    
        //store to DB using User.php
        // name,email,password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successsfully store user',
            'data' => $user,
        ]);
    }

    public function delete(User $user){
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successsfully deleted'
        ]);

    }

    public function show(User $user){

        return response()->json([
            'success' => true,
            'message' => 'Successsfully retrieved',
            'data' => $user
        ]);

    }

    public function update(Request $request,User $user){
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successsfully updated'
        ]);

    }
}
