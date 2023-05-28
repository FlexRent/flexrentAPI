<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriesRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de produtos retornada',
            'categories' => CategoryResource::collection($categories)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        $category = new Category();

        $category->name = $request->name;
        $category->description = $request->description;
        
        $category->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Categoria criada com sucesso',
            'categories' => new CategoryResource($category)
        ], 200);
    }

    public function update (CategoriesRequest $request, Category $category){

        $category = Category::find($category->id);

        $category->name = $request->name;
        $category->description = $request->description;

        $category->update();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Categoria atualizada com sucesso'
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response() -> json([
            'status' => '200',
            'mensagem' => 'Categoria deletada'
        ], 200);
    }
}