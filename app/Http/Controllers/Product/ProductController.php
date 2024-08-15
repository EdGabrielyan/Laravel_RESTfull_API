<?php

namespace App\Http\Controllers\Product;

use App\Enums\Status\StatusCodes;
use App\Enums\Success\SuccessMessages;
use App\Exceptions\NotFoundException;
use App\Http\Action\Product\ProductAction;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductPaginationRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function __construct(
        protected ProductAction $action
    )
    {
    }


    /**
     * @throws NotFoundException
     */
    public function index(ProductPaginationRequest $request): JsonResponse
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
    public function store(ProductCreateRequest $request): JsonResponse
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
    public function show(int $id): JsonResponse
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
    public function update(ProductUpdateRequest $request, int $id): JsonResponse
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
