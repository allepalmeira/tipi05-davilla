<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\JsonResponse;

class BannerController extends Controller
{
    public function index(): JsonResponse
    {
        $banners = Banner::where('status_banner', 'ATIVO')
            ->orderBy('ordem_banner')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }
}