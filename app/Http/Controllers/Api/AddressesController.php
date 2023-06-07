<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addresses;
use App\Http\Resources\AddressesResource;
use App\Http\Requests\AddressesRequest;
use Illuminate\Http\Response;


// TODO: Criar uma forma de ver se o usuário logado é o dono do endereço na classe toda
class AddressesController extends Controller
{
    /**
     * Lista todos os endereços do usuário logado
     */
    public function index()
    {
        $addresses = Addresses::paginate(10);

        if (!$addresses->isEmpty()) {
            $paginationData = $addresses->toArray();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de endereços retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalAddresses' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'addresses' => AddressesResource::collection($addresses)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Nenhum endereços encontrado',
        ], Response::HTTP_OK);
    }


    /**
     * Cria um novo endereço
     */
    public function store(AddressesRequest $request)
    {
        $address = new Addresses($request->all());
        $address->user_id = auth()->user()->id;

        if ($address->save()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Endereço criado com sucesso',
                'addresses' => new AddressesResource($address)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'mensagem' => 'Erro ao criar endereço',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Atualiza um endereço
     */
    public function update(AddressesRequest $request, Addresses $address)
    {

        if (Addresses::find($address->id)) {
            $address->update($request->all());

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Endereço atualizado com sucesso'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'mensagem' => 'Endereço não encontrado'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Deleta um endereço
     */
    public function destroy(Addresses $address)
    {

        if ($address->user_id == auth()->user()->id) {
        $address->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Endereço deletado'
        ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'mensagem' => 'Você não tem permissão para deletar este endereço'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
