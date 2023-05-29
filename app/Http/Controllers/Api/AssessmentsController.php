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
    public function index()
    {
        $assessments = Assessments::all();

        if (!$assessments->isEmpty()) {
            return response()->json([
                'status' => 200,
                'mensagem' => 'Lista de avaliações retornada',
                'assessments' => AssessmentsResource::collection($assessments)
            ], 200);
        }

        return response()->json([
            'status' => Response::HTTP_NOT_FOUND,
            'mensagem' => 'Nenhuma avaliação encontrada'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Store a newly created resource in storage.
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
            'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            'mensagem' => 'Erro ao criar avaliação'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
