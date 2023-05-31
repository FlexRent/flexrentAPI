<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Http\Resources\CartResource;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Response;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de pedidos de aluguel retornada',
            'pedidos de aluguel' => CartResource::collection($cart)
        ], 200);
    }

    public function showCartUser()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->paginate(10);

        if (!$carts->isEmpty()) {
            $paginationData = $carts->toArray();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de peidos de alguel retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalPedidosDeAluguel' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'pedidos de aluguel' => CartResource::collection($carts)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Nenhum pedidos de aluguel encontrado',
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        $cart = new Cart($request->all());
        $cart->user_id = auth()->user()->id;

        
        if( $cart->save() ){

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Pedido de aluguel realizado',
                'pedido de aluguel' => new CartResource($cart)
            ], Response::HTTP_OK);
            
        }

        return response()->json([
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'mensagem' => 'Erro ao criar pedido de aluguel',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {

        if ($cart->user_id == auth()->user()->id) {

            $cart->delete();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Pedido de aluguel deletado'
            ], Response::HTTP_OK);
            
        }

    }

}
