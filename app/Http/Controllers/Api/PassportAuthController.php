<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\UserResource;
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
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cpf' => $request->cpf,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
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
            $user = auth()->user();
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            $user->update(['remember_token' => $token]);

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

    public function recoverPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update(['password' => bcrypt($request->password)]);
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Senha alterada com sucesso',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'mensagem' => 'Não autorizado',
            ], Response::HTTP_UNAUTHORIZED);
        }
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
            'user' => new UserResource($user)
        ], Response::HTTP_OK);
    }
}
