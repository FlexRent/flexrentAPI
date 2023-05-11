<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductsRequest;
// use Illuminate\Support\Carbon;
// use Carbon\Carbon;


class ProductController extends Controller
{
    public function index(){

        $products = Product::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de produtos retornada',
            'products' => ProductResource::collection($products)
        ], 200);

    }

    public function store(ProductsRequest $request){

        $product = new Product();

        $product->name = $request->name;
        $product->description = $request->description;
        $product->model = $request->model;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->status = $request->status;


        // $withdrawal_week = $request->withdrawal_week;
        // $withdrawal_week->format('H:i:s');
        // $withdrawal_week_formated = Carbon::createFromFormat('H:i:s', $withdrawal_week)->format('H:i');
        // $withdrawal_week_formated->format('H:i:s');
        $product->withdrawal_week = $request->withdrawal_week;

        $product->delivery_week = $request->delivery_week;
        $product->weekend_withdrawal = $request->weekend_withdrawal;
        $product->weekend_delivery = $request->weekend_delivery;

        $product->save();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Produto criado com sucesso',
            'produto' => new ProductResource($product)
        ], 200);

    }

    public function update (ProductsRequest $request, Product $product){

        $product = Product::find($product->id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->model = $request->model;
        $product->price = $request->price;
        $product->image = $request->image;
        $product->status = $request->status;
        $product->withdrawal_week = $request->withdrawal_week;
        $product->delivery_week = $request->delivery_week;
        $product->weekend_withdrawal = $request->weekend_withdrawal;
        $product->weekend_delivery = $request->weekend_delivery;

        $product->update();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Produto atualizado com sucesso'
        ], 200);


    }

    public function destroy (Product $product){

        $product->delete();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Produto deletado'
        ], 200);

    }
}
