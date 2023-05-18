<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json([
            'status' => '200',
            'mensagem' => 'Usuário criado com sucesso',
            'token' => $token
        ], 200);
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'status' => '200',
                'mensagem' => 'Token do usuário',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => '401',
                'mensagem' => 'Não autorizado',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();

        return response()->json([
            'status' => '200',
            'mensagem' => 'Logout realizado com sucesso',
        ], 200);
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json([
            'status' => '200',
            'mensagem' => 'Informações do usuário',
            'user' => $user
        ], 200);
    }
}
