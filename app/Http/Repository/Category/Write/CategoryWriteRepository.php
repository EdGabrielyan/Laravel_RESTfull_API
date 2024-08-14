<?php

namespace App\Http\Repository\Category\Write;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CategoryWriteRepository implements CategoryWriteRepositoryInterface
{
    public function save(Collection $data): EloquentCollection
    {
        $category = Category::create([
            'name' => $data->get('name')
        ]);
        return EloquentCollection::make($category);
    }

    public function delete(int $id)
    {
        $category = Category::where('id', $id)->firstOrFail();
        $category->delete();
    }

    public function update(Collection $data, int $id): EloquentCollection
    {
        $product = Category::where('id', $id)->firstOrFail();
        $product->update(['name' => $data->get('name')]);

        return EloquentCollection::make($product);
    }
}
