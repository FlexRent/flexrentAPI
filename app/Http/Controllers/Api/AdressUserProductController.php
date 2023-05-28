<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdressUserProduct;
use App\Http\Resources\AdressUserProductResource;
use App\Http\Requests\AdressUserProductRequest;

class AdressUserProductController extends Controller
{
    public function index()
    {
        $address = AdressUserProduct::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de avaliações retornada',
            'addresses' => AdressUserProductResource::collection($address)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdressUserProductRequest $request)
    {
        $address = new AdressUserProduct();

        $address->address_id = $request->address_id;
        $address->user_id = $request->user_id;
        $address->product_id = $request->product_id;
        
        $address->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Avaliação criada com sucesso',
            'address' => new AdressUserProductResource($address)
        ], 200);
    }
}
