<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductsRequest;

class ProductController extends Controller
{
    /**
     * Lista todos os produtos cadastrados
     */
    public function index()
    {
        $products = Product::paginate(10); // 10 produtos por página

        if ($products->count() > 0) {
            $paginationData = $products->toArray();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de produtos retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'products' => ProductResource::collection($products)
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'mensagem' => 'Nenhum produto encontrado',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Lista todos produtos cadastrados de um usuario especifico
     */
    public function showProductsUser()
    {
        $products = Product::where('user_id', auth()->user()->id)->paginate(10);

        if ($products->count() > 0) {
            $paginationData = $products->toArray();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de produtos retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'products' => ProductResource::collection($products)
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'mensagem' => 'Nenhum produto encontrado',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Lista um produto especifico
     */
    public function showOne(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($product) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto encontrado',
                'product' => $product
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'mensagem' => 'Nenhum produto encontrado',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Grava um novo produto
     */
    public function store(ProductsRequest $request)
    {

        $product = new Product();

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
        $product->user_id = auth()->user()->id;
        // $withdrawal_week = $request->withdrawal_week;
        // $withdrawal_week->format('H:i:s');
        // $withdrawal_week_formated = Carbon::createFromFormat('H:i:s', $withdrawal_week)->format('H:i');
        // $withdrawal_week_formated->format('H:i:s');

        $product->save();

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Produto criado com sucesso',
            'produto' => new ProductResource($product),
        ], Response::HTTP_OK);
    }

    /**
     * Atualiza um produto especifico
     */
    public function update(ProductsRequest $request, Product $product)
    {

        $user = Product::where('user_id', auth()->user()->id)->first();

        if ($product->user_id == $user->user_id) {
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

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto atualizado com sucesso'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'mensagem' => 'Você não tem permissão para atualizar este produto'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Deleta um produto especifico
     */
    public function destroy(Product $product)
    {
        $user = Product::where('user_id', auth()->user()->id)->first();

        if ($product->user_id == $user->user_id) {

            $product->delete();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto deletado'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'status' => Response::HTTP_UNAUTHORIZED,
                'mensagem' => 'Você não tem permissão para deletar este produto'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
