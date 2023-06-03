<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ProductImage;
use App\Http\Resources\ProductImageResource;
use App\Http\Requests\ProductImageRequest;

class ProductImageController extends Controller
{
    /**
     * Lista todas as categorias
     */
    public function index()
    {
        $productImages = ProductImage::paginate(10);

        if (!$productImages->isEmpty()) {
            $paginationData = $categories->toArray();
            return response()->json([
                'status' =>  Response::HTTP_OK,
                'mensagem' => 'Lista de imagens do produto retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'productImages' => ProductImageResource::collection($productImages)
            ],  Response::HTTP_OK);
        }
    }

    /**
     * Cria uma nova imagem
     */
    public function store(ProductImageRequest $request)
    {
        
        dd($request->all());
        $productImages = new ProductImage($request->all());
        

        if ($category->save()) {
            return response()->json([
                'status' =>  Response::HTTP_OK,
                'mensagem' => 'Imagem criada com sucesso',
                'productImages' => new ProductImageResource($productImages)
            ],  Response::HTTP_OK);
        }

        return response()->json([
            'status' =>  Response::HTTP_BAD_REQUEST,
            'mensagem' => 'Erro ao criar categoria',
        ],  Response::HTTP_BAD_REQUEST);
    }

    /**
     * Atualiza uma imagem
     */
    // public function update(CategoriesRequest $request, Category $category)
    // {
    //     if (Category::find($category->id)) {
    //         $category->update($request->all());

    //         return response()->json([
    //             'status' => Response::HTTP_OK,
    //             'mensagem' => 'Categoria atualizada com sucesso'
    //         ],  Response::HTTP_OK);
    //     }

    //     return response()->json([
    //         'status' => Response::HTTP_NOT_FOUND,
    //         'mensagem' => 'Erro ao atualizar categoria'
    //     ],  Response::HTTP_NOT_FOUND);
    // }

    // /**
    //  * Apaga uma imagem
    //  */
    // public function destroy(Category $category)
    // {
    //     // if(é um administrador?){
    //     $category->delete();
    //     return response()->json([
    //         'status' => Response::HTTP_OK,
    //         'mensagem' => 'Categoria deletada'
    //     ],  Response::HTTP_OK);

    //     // return response()->json([
    //     //     'status' => Response::HTTP_UNAUTHORIZED,
    //     //     'mensagem' => 'Você não tem permissão para deletar essa categoria'
    //     // ],  Response::HTTP_UNAUTHORIZED);
    // }
}
