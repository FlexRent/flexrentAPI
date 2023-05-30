<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardsRequest;
use App\Http\Resources\CardResource;
use App\Models\Cards;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CardController extends Controller
{
    /**
     * Lista todos os cartões do usuário logado
     */
    public function index()
    {
        $card = Cards::where('user_id', auth()->user()->id)->paginate(10);

        if (!$card->isEmpty()) {
            $paginationData = $card->toArray();
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de cartões retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'cartões' => CardResource::collection($card)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'mensagem' => 'Nenhum cartão encontrado',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Cria um novo cartão
     */
    public function store(Request $request)
    {
        $card = new Cards($request->all());
        $card->user_id = auth()->user()->id;

        if ($card->save()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Cartão criado com sucesso',
                'cartão' => new CardResource($card)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'mensagem' => 'Erro ao criar cartão',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Atualiza um cartão
     */
    public function update(CardsRequest $request, Cards $card)
    {
        if ($card->user_id == auth()->user()->id) {
            $card->update($request->all());
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Cartão atualizado com sucesso'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'mensagem' => 'Você não tem permissão para atualizar esse cartão'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Deleta um cartão
     */
    public function destroy(Cards $card)
    {
        if ($card->user_id == auth()->user()->id) {
            $card->delete();
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Cartão deletado com sucesso',
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'mensagem' => 'Você não tem permissão para deletar esse cartão',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
