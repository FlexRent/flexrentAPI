<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductsRequest;

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

        $product->update();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Produto atualizado'
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
