<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LevelController extends Controller
{

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $levels = [];

            if (Gate::allows('view_any_log')) {
                $levels = Level::orderBy('name', 'asc')->get();
            }
            return response()->json(compact('levels'), Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
