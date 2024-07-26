<?php

namespace App\Http\Repository\Product\Write;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface ProductWriteRepositoryInterface
{
    public function Save(Collection $data): EloquentCollection;
    public function delete(int $id);
    public function update(Collection $data, int $id): EloquentCollection;
}
