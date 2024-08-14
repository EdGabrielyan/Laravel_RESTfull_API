<?php

namespace App\Http\Repository\Category\Read;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class CategoryReadRepository implements CategoryReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection
    {
        return Category::offset($data->get('offset'))
            ->limit($data->get('limit'))
            ->get();
    }

    public function getById(int $id): EloquentCollection
    {
        $product = Category::findOrFail($id);

        return EloquentCollection::make($product);
    }
}