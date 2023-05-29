<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductsRequest;

// TODO: Implementar a media da nota do produto
// TODO: Implementar o relacionamento com categoria e marca
class ProductController extends Controller
{
    /**
     * Lista todos os produtos cadastrados
     */
    public function index()
    {
        $products = Product::paginate(10); // 10 produtos por página

        if (!$products->isEmpty()) {
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
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Nenhum produto encontrado',
        ], Response::HTTP_OK);
    }

    /**
     * Lista um produto especifico
     */
    public function showOne(Request $request)
    {
        $productId = $request->product_id;

        if (!is_numeric($productId)) {
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'mensagem' => 'ID do produto inválido',
            ], Response::HTTP_BAD_REQUEST);
        }

        $product = Product::find($productId);

        if ($product) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto encontrado',
                'product' => $product
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Nenhum produto encontrado',
        ], Response::HTTP_OK);
    }

    /**
     * Lista todos produtos cadastrados de um usuario especifico
     */
    public function showProductsUser()
    {
        $products = Product::where('user_id', auth()->user()->id)->paginate(10);

        if (!$products->isEmpty()) {
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
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Nenhum produto encontrado',
        ], Response::HTTP_OK);
    }

    /**
     * Lista produtos com filtros
     */
    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->filled('COLUNA_FILTRO') && $request->filled('FILTRO')) {
            $query->where($request->input('COLUNA_FILTRO'), 'LIKE', "%{$request->input('FILTRO')}%");
        }

        if ($request->filled('COLUNA_ORDER') && $request->filled('ORDER')) {
            $orderOperator = $request->input('ORDER') == 'asc' ? 'asc' : 'desc';
            $query->orderBy($request->input('COLUNA_ORDER'), $orderOperator);
        }

        $products = $query->paginate(10);
        $paginationData = $products->toArray();

        $queryParams = $request->only(['COLUNA_ORDER', 'ORDER', 'COLUNA_FILTRO', 'FILTRO']);
        $queryString = http_build_query($queryParams);

        $prevPageUrl = isset($paginationData['prev_page_url']) ? $paginationData['prev_page_url'] . '&' . $queryString : null;
        $nextPageUrl = isset($paginationData['next_page_url']) ? $paginationData['next_page_url'] . '&' . $queryString : null;

        if (!$products->isEmpty()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de produtos retornada',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $prevPageUrl,
                    'next_page_url' => $nextPageUrl,
                ],
                'products' => ProductResource::collection($products)
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => Response::HTTP_OK,
            'mensagem' => 'Nenhum produto encontrado',
        ], Response::HTTP_OK);
    }

    /**
     * Grava um novo produto
     */
    public function store(ProductsRequest $request)
    {
        $product = new Product($request->all());
        $product->user_id = auth()->user()->id; // acho que nao precisa disso

        if ($product->save()) {
            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto criado com sucesso',
                'produto' => new ProductResource($product),
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'mensagem' => 'Erro ao criar produto',
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Atualiza um produto especifico
     */
    public function update(ProductsRequest $request, Product $product)
    {
        if ($product->user_id == auth()->user()->id) {
            $product->update($request->all());

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto atualizado com sucesso'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'mensagem' => 'Você não tem permissão para atualizar este produto'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Deleta um produto especifico
     */
    public function destroy(Product $product)
    {
        if ($product->user_id == auth()->user()->id) {
            $product->delete();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Produto deletado'
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_UNAUTHORIZED,
            'mensagem' => 'Você não tem permissão para deletar este produto'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
