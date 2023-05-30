<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessments;
use App\Http\Resources\AssessmentsResource;
use App\Http\Requests\AssessmentsRequest;
use Illuminate\Http\Response;

class AssessmentsController extends Controller
{
    /**
     * Lista todas as avaliações de um usuário
     */
    public function user()
    {
        $assessments = Assessments::where('user_id', auth()->user()->id)->paginate(10);

        if (!$assessments->isEmpty()) {
            $scoreUser = Assessments::where('user_id', auth()->user()->id)->avg('assessments_user');
            $paginationData = $assessments->toArray();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de avaliações do cliente',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'score' => $scoreUser,
                'assessments' => AssessmentsResource::collection($assessments)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'mensagem' => 'Nenhuma avaliação de usuario encontrada'
        ], Response::HTTP_NOT_FOUND);
    }

    public function product(Request $request)
    {
        $assessments = Assessments::where('product_id', $request->header('product_id'))->paginate(10);

        if (!$assessments->isEmpty()) {
            $scoreProduct = Assessments::where('product_id', $request->header('product_id'))->avg('assessments_product');
            $paginationData = $assessments->toArray();

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Lista de avaliações do produto',
                'pagination' => [
                    'currentPage' => $paginationData['current_page'],
                    'totalPages' => $paginationData['last_page'],
                    'totalProducts' => $paginationData['total'],
                    'perPage' => $paginationData['per_page'],
                    'prev_page_url' => $paginationData['prev_page_url'],
                    'next_page_url' => $paginationData['next_page_url'],
                ],
                'score' => $scoreProduct,
                'assessments' => AssessmentsResource::collection($assessments)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'mensagem' => 'Nenhuma avaliação de produto encontrada'
        ], Response::HTTP_NOT_FOUND);
    }


    /**
     * Cria uma nova avaliação
     */
    public function store(AssessmentsRequest $request)
    {
        $assessment = new Assessments($request->all());

        if ($assessment->save()) {

            return response()->json([
                'status' => Response::HTTP_OK,
                'mensagem' => 'Avaliação criada com sucesso',
                'assessments' => new AssessmentsResource($assessment)
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'mensagem' => 'Erro ao criar avaliação'
        ], Response::HTTP_BAD_REQUEST);
    }
}
