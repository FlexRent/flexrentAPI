<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addresses;
use App\Http\Resources\AddressesResource;
use App\Http\Requests\AddressesRequest;

class AddressesController extends Controller
{
    public function index()
    {
        $address = Addresses::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de endereços retornada',
            'addresses' => AddressesResource::collection($address)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressesRequest $request)
    {
        $address = new Addresses();

        $address->street = $request->street;
        $address->number = $request->number;
        $address->complement = $request->complement;
        $address->district = $request->district;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;
        
        $address->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Endereço criado com sucesso',
            'addresses' => new AddressesResource($address)
        ], 200);
    }

    public function update (AddressesRequest $request, Addresses $address){

        $address = Addresses::find($address->id);

        $address->street = $request->street;
        $address->number = $request->number;
        $address->complement = $request->complement;
        $address->district = $request->district;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->country = $request->country;
        $address->zipcode = $request->zipcode;

        $address->update();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Endereço atualizado com sucesso'
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addresses $address)
    {
        $address->delete();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Endereço deletado'
        ], 200);
    }
}

