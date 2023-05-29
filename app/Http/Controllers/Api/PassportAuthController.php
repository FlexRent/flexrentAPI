<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\Response;

class PassportAuthController extends Controller
{
    /**
     * Cria um novo usuário
     */
    public function register(UsersRequest $request)
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

    /**
     * Realiza o login do usuário
     */
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

    /**
     * Realiza o logout do usuário
     */
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


    /**
     * Retorna as informações do usuário logado
     */
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
