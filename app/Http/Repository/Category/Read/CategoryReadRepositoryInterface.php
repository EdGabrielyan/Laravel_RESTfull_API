<?php

namespace App\Http\Repository\Category\Read;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface CategoryReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection;
    public function getById(int $id): EloquentCollection;
}
