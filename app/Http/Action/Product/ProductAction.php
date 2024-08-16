<?php

namespace App\Http\Action\Product;

use App\Http\Repository\Product\Read\ProductReadRepositoryInterface;
use App\Http\Repository\Product\Write\ProductWriteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class ProductAction
{
    public function __construct(
        protected ProductReadRepositoryInterface  $productReadRepository,
        protected ProductWriteRepositoryInterface $productWriteRepository
    )
    {
    }

    public function getData(Collection $data): EloquentCollection
    {
        return $this->productReadRepository->get($data);
    }

    public function storeData(Collection $data): EloquentCollection
    {
        if (auth()->user()->cannot('create', Product::class)) {
            abort(403);
        }
        //Gate::authorize('create');
        return $this->productWriteRepository->Save($data);
    }

    public function getDataById(int $id): EloquentCollection
    {
        return $this->productReadRepository->getById($id);
    }

    public function updateData(Collection $data, int $id): EloquentCollection
    {
        Gate::authorize('update', '');
        return $this->productWriteRepository->update($data, $id);
    }

    public function deleteData(int $id)
    {
        Gate::authorize('delete');
        return $this->productWriteRepository->delete($id);
    }
}
