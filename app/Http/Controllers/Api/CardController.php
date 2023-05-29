<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardsRequest;
use App\Http\Resources\CardResource;
use App\Models\Cards;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $card = Cards::where('user_id', auth()->user()->id)->paginate(10);

        if (!$card->isEmpty()) {
            $paginationData = $card->toArray();
            return response()->json([
                'status' => '200',
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
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $card = new Cards();

        $card->card_name = $request->card_name;
        $card->card_title = $request->card_title;
        $card->card_number = $request->card_number;
        $card->card_cvv = $request->card_cvv;
        $card->card_expiration_date = $request->card_expiration_date;
        $card->user_id = auth()->user()->id;


        $card->save();

        return response()->json([
            'status' => '200',
            'mensagem' => 'Cartão criado com sucesso',
            'cartão' => $card
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CardsRequest $request, Cards $card)
    {
        $user = Cards::where('user_id', auth()->user()->id)->first();

        if ($card->user_id == $user->user_id) {
            $card->card_name = $request->card_name;
            $card->card_title = $request->card_title;
            $card->card_number = $request->card_number;
            $card->card_cvv = $request->card_cvv;
            $card->card_expiration_date = $request->card_expiration_date;

            $card->update();

            return response()->json([
                'status' => '200',
                'mensagem' => 'Cartão atualizado com sucesso'
            ], 200);
        } else {
            return response()->json([
                'status' => '401',
                'mensagem' => 'Você não tem permissão para atualizar esse cartão'
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cards $card)
    {
        $user = Cards::where('user_id', auth()->user()->id)->first();

        if ($card->user_id == $user->user_id) {
            $card->delete();
            return response()->json([
                'status' => '200',
                'mensagem' => 'Cartão deletado com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => '401',
                'mensagem' => 'Você não tem permissão para deletar esse cartão',
            ], 401);
        }
    }
}
