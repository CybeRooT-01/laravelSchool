<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json([
                'token' => $token,
                'user' => $user
            ], 200);
        }
        return response()->json(['message' => 'nope... come again !'], 401);
    }

    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'roles' => $request->roles
        ]);

        $token = $user->createToken('MyApp')->accessToken;
        return response()->json(['token' => $token], 201);
    }
    public function logout($id)
    {
        $user = User::find($id);
        $user->tokens()->delete();
        return response()->json(['message' => 'Deconnexion reussie']);
    }
}
