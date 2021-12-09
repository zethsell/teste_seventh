<?php

namespace App\Http\Controllers;

use App\Models\AccessLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AccessLogController extends Controller
{

    public function __invoke(): JsonResponse
    {
        try {
            $logs = [];

            if (Gate::allows('view_any_log')) {
                $logs = AccessLog::with(['user' => function ($user) {
                    $user->withTrashed();
                }])->orderBy('id')->get();
            }

            return response()->json(compact('logs'), Response::HTTP_OK);
        } catch (Throwable $e) {
            return response()->json($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
