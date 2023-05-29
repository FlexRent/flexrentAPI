<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        if (!$categories->isEmpty()) {
            $paginationData = $categories->toArray();
            return response()->json([
                'status' =>  Response::HTTP_OK,
                'mensagem' => 'Lista de produtos retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'categories' => CategoryResource::collection($categories)
            ],  Response::HTTP_OK);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        $category = new Category($request->all());

        if ($category->save()) {
            return response()->json([
                'status' =>  Response::HTTP_OK,
                'mensagem' => 'Categoria criada com sucesso',
                'categories' => new CategoryResource($category)
            ],  Response::HTTP_OK);
        }

        return response()->json([
            'status' =>  Response::HTTP_BAD_REQUEST,
            'mensagem' => 'Erro ao criar categoria',
        ],  Response::HTTP_BAD_REQUEST);
    }

    public function update(CategoriesRequest $request, Category $category)
    {

        if (CategoriesRequest::find($category->id)) {
            $category->update($request->all());

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Categoria atualizada com sucesso'
            ],  Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'mensagem' => 'Erro ao atualizar categoria'
        ],  Response::HTTP_NOT_FOUND);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // if(é um administrador?){
        $category->delete();
        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Categoria deletada'
        ],  Response::HTTP_OK);

        // return response()->json([
        //     'status' => Response::HTTP_UNAUTHORIZED,
        //     'mensagem' => 'Você não tem permissão para deletar essa categoria'
        // ],  Response::HTTP_UNAUTHORIZED);
    }
}
