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

        //$category->products()->attach($data->get('id'));

        return EloquentCollection::make($category);
    }
}
