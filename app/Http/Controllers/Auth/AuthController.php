<?php

namespace App\Http\Controllers\Auth;

use App\Http\Action\Auth\AuthAction;
use App\Http\Requests\Auth\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function __construct(
        protected AuthAction $authAction
    )
    {
    }

    public function login(AuthRequest $request): JsonResponse
    {
        $data = $request->collect();
        return response()->json($this->authAction->generateToken($data));
    }

    public function logout()
    {
        return response()->json($this->authAction->logout());
    }
}
