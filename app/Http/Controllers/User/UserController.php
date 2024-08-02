<?php

namespace App\Http\Controllers\User;

use App\Enums\Success\SuccessMessages;
use App\Exceptions\NotFoundException;
use App\Exceptions\User\UserNotRegisteredException;
use App\Http\Action\User\UserAction;
use App\Http\Requests\User\UserPaginationRequest;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(
        protected UserAction $userAction
    )
    {
    }

    /**
     * @throws UserNotRegisteredException
     */
    public function register(UserRequest $request): JsonResponse
    {
        $data = $request->collect();
        try {
            return response()->json($this->userAction->storeData($data));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw new UserNotRegisteredException();
        }
    }

    /**
     * @throws NotFoundException
     */
    public function show(int $id): JsonResponse
    {
        try {
            return response()->json($this->userAction->getDataById($id));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException;
        }
    }

    /**
     * @throws NotFoundException
     */
    public function index(UserPaginationRequest $request): JsonResponse
    {
        $data = $request->collect();
        try {
            return Cache::rememberForever("index $request->get(offset) $request->get(limit)",
                fn() => response()->json($this->userAction->getData($data)));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException;
        }
    }

    public function update(UserUpdateRequest $request): JsonResponse
    {
        $data = $request->collect();
        return response()->json($this->userAction->updateData($data));
    }

    public function destroy(): JsonResponse
    {
        $this->userAction->deleteData();
        return response()->json(['message' => SuccessMessages::Success->value]);
    }
}
