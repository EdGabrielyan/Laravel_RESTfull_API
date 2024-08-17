<?php

namespace App\Http\Action\Product;

use App\Http\Repository\Product\Read\ProductReadRepositoryInterface;
use App\Http\Repository\Product\Write\ProductWriteRepositoryInterface;
use App\Models\Product;
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
        Gate::define('store-product', function (Product $product) {
            return auth()->id() === $product->user_id;
        });
        return $this->productWriteRepository->Save($data);
    }

    public function getDataById(int $id): EloquentCollection
    {
        return $this->productReadRepository->getById($id);
    }

    public function updateData(Collection $data, int $id): EloquentCollection
    {
        Gate::define('update-product', function (Product $product) {
            return auth()->id() === $product->user_id;
        });
        return $this->productWriteRepository->update($data, $id);
    }

    public function deleteData(int $id)
    {
        Gate::define('delete-product', function (Product $product) {
            return auth()->id() === $product->user_id;
        });
        return $this->productWriteRepository->delete($id);
    }
}
