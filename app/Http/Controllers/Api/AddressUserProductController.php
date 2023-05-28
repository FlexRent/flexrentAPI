<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddressUserProduct;
use App\Http\Resources\AddressUserProductResource;
use App\Http\Requests\AddressUserProductRequest;

class AddressUserProductController extends Controller
{
    public function index()
    {
        $address = AddressUserProduct::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de relacionamentos entre Endereço - Usuário/Produto retornada',
            'addresses' => AddressUserProductResource::collection($address)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressUserProductRequest $request)
    {
        $address = new AddressUserProduct();

        $address->address_id = $request->address_id;
        $address->user_id = $request->user_id;
        $address->product_id = $request->product_id;
        
        $address->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Relacionamento entre Endereço - Usuário/Produto criado com sucesso',
            'address' => new AddressUserProductResource($address)
        ], 200);
    }
}
