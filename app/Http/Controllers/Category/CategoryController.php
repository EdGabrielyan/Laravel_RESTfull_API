<?php

namespace App\Http\Controllers\Category;

use App\Enums\Status\StatusCodes;
use App\Enums\Success\SuccessMessages;
use App\Exceptions\NotFoundException;
use App\Http\Action\Category\CategoryAction;
use App\Http\Requests\Category\CategoryPaginationRequest;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class CategoryController
{
    public function __construct(
        protected CategoryAction $action
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function index(CategoryPaginationRequest $request): JsonResponse
    {

        $data = $request->collect();
        try {
            return response()->json($this->action->getData($data));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException();
        }
    }

    /**
     * @throws NotFoundException
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $data = $request->collect();
        try {
            return response()->json($this->action->storeData($data));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException();
        }
    }

    /**
     * @throws NotFoundException
     */
    public function show(string $id): JsonResponse
    {
        try {
            return response()->json($this->action->getDataById($id));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException();
        }
    }

    /**
     * @throws NotFoundException
     */
    public function update(CategoryRequest $request, int $id): JsonResponse
    {
        $data = $request->collect();
        try {
            return response()->json($this->action->updateData($data, $id));
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException();
        }
    }

    /**
     * @throws NotFoundException
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->action->deleteData($id);
            return response()->json(['message' => SuccessMessages::Success->value], StatusCodes::Success->value);
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            throw new NotFoundException();
        }
    }
}
