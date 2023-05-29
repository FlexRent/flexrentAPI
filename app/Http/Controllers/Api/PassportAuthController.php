<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\Response;

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
            'status' => Response::HTTP_OK,
            'mensagem' => 'Usuário criado com sucesso',
            'token' => $token
        ], Response::HTTP_OK);
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
                'status' => Response::HTTP_OK,
                'mensagem' => 'Token do usuário',
                'token' => $token
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'mensagem' => 'Não autorizado',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(Request $request)
    {
        $accessToken = auth()->user()->token();
        $token = $request->user()->tokens->find($accessToken);
        $token->revoke();

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Logout realizado com sucesso',
        ], Response::HTTP_OK);
    }

    public function userInfo()
    {
        $user = auth()->user();
        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Informações do usuário',
            'user' => $user
        ], Response::HTTP_OK);
    }
}
