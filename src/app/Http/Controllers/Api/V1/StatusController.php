<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StatusController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'aplicacao' => 'Confeitaria DaVilla',
                'api' => 'v1',
                'status' => 'online',
            ]
        ]);
    }
}