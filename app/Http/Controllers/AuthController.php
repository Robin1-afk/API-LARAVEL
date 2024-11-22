<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller// inicio de clase
{
    //Metodo para el registro de usuarios en la BD
    public function storeUser(Request $request)
    {
        try { //Try, para capturar cualquier excepción que se pueda presentar
            
            $request->validate([ //Se valida si la data que se esta enviando es la esperada
                'name'      => 'required|string',
                'email'     => 'required|string|email|unique:users,email',
                'password'  => 'required|string|min:6',
                'rol'       => 'required|numeric',
                'id_negocio'=> 'required|numeric',
            ]);

            
            // Intentar crear el usuario
            $user = User::create([ //Se realiza la inserción del registro en la BD
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'rol'       => $request->rol,
                'id_negocio'=> $request->id_negocio,
            ]);

            $token = JWTAuth::fromUser($user); //Se genera el token del usuario

            return response()->json(['status' => 200, ' message' => 'Se registro exitosamente'], 200);//Se retorna si la respuesta con el status 200

        } catch (ValidationException $e) {
            // Capturar errores de validación y devolver un 400
            return response()->json(['error' => 'Error de validación', 'messages' => $e->errors()], 400);
    
        } catch (\Exception $e) {
            // Si ocurre cualquier otro tipo de error, manejarlo y devolver un código 500
            return response()->json(['error' => 'Hubo un problema en el servidor', 'message' => $e->getMessage()], 500);
        }
    }

    //Login, metodo que se encarga de logear al usuarios con las credenciales enviadas
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');//Credenciales enviadas

        if (!$token = JWTAuth::attempt($credentials)) {//si las credenciales no coinciden, entonces se retornara un 401
            return response()->json(['error' => 'usuario o contraseña incorrecto'], 401);
        }

        return response()->json(['token' => $token]);//Retorno de las credenciales
    }
} //Fin de la clase
