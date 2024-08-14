<?php

namespace App\Http\Repository\Category\Write;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface CategoryWriteRepositoryInterface
{
    public function save(Collection $data): EloquentCollection;
}
