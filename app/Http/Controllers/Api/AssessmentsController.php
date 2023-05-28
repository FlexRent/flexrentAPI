<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessments;
use App\Http\Resources\AssessmentsResource;
use App\Http\Requests\AssessmentsRequest;

class AssessmentsController extends Controller
{
    public function index()
    {
        $assessment = Assessments::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista de avaliações retornada',
            'assessments' => AssessmentsResource::collection($assessment)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssessmentsRequest $request)
    {
        $assessment = new Assessments();

        $assessment->assessments = $request->assessments;
        $assessment->comments = $request->comments;
        $assessment->user_id = $request->user_id;
        $assessment->product_id = $request->product_id;
        
        $assessment->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Avaliação criada com sucesso',
            'assessments' => new AssessmentsResource($assessment)
        ], 200);
    }
}
