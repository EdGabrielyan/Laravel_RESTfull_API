<?php

namespace App\Http\Repository\Product\Write;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductWriteRepository implements ProductWriteRepositoryInterface
{
    public function Save(Collection $data): EloquentCollection
    {
        $product = Product::create([
            'name' => $data->get('name'),
            'user_id' => auth()->id()
        ]);

        $product->categories()->attach($data->get('category_id'));

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

        DB::table('product_category')->where('product_id', $id)->update(['category_id' => $data->get('category_id')]);

        return EloquentCollection::make($product);
    }
}
