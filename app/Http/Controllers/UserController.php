<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);


        $user->token = $user->createToken("Application Token requested from: " . $request->header('User-Agent', 'Vue App'))->plainTextToken;

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        //
    }
}
