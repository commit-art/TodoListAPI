<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateTokenRequest;
use App\Services\SanctumApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SanctumController extends Controller
{
    public function __construct(protected SanctumApiService $service)
    {
    }

    public function create(CreateTokenRequest $request): JsonResponse
    {
        $token = $this->service->createToken($request->user, $request->userAgent());

        return response()->json($token, Response::HTTP_CREATED);
    }

    public function revokeAll(): JsonResponse
    {
        $this->service->removeAllTokens();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
