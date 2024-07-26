<?php

namespace App\Http\Repository\Product\Read;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class ProductReadRepository implements ProductReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection
    {
        return Product::type($data->get('type', 0))
            ->with('user')
            ->offset($data->get('offset'))
            ->limit($data->get('limit'))
            ->get();
    }

    public function getById(int $id): EloquentCollection
    {
        $product = Product::with('user')->findOrFail($id);

        return EloquentCollection::make($product);
    }
}
