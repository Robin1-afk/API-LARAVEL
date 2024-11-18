<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'string',
            'email' => 'string|email|unique:users,email',
            'password' => 'string|min:6',
        ]);

        try {
            // Intentar crear el usuario
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(['message' => 'Se registro exitosamente', 'token' => $token], 200);

        } catch (\Exception $e) {
            // Si ocurre cualquier otro tipo de error, manejarlo y devolver un código 500
            return response()->json(['error' => 'Hubo un problema en el servidor', 'message' => $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }
}
