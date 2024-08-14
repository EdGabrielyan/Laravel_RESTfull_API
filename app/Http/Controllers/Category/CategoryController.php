<?php

namespace App\Http\Controllers\Category;

use App\Exceptions\NotFoundException;
use App\Http\Action\Category\CategoryAction;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController
{
    public function __construct(
        protected CategoryAction $action
    )
    {
    }

    public function index()
    {

    }

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

    public function show(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }
}
