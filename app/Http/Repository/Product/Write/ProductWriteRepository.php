<?php

namespace App\Http\Repository\Product\Write;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class ProductWriteRepository implements ProductWriteRepositoryInterface
{
    public function Save(Collection $data): EloquentCollection
    {
        $product = Product::create([
            'name' => $data->get('name'),
            'user_id' => auth()->id()
        ]);

        return EloquentCollection::make($product);
    }

    public function delete(int $id): void
    {
        $product = Product::where([['id', $id], ['user_id', auth()->id()]])->firstOrFail();
        $product->delete();
    }

    public function update(Collection $data, int $id): EloquentCollection
    {
        $product = Product::where([['id', $id], ['user_id', auth()->id()]])->firstOrFail();
        $product->update(['name' => $data->get('name')]);

        return EloquentCollection::make($product);
    }
}
