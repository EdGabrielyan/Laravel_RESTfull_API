<?php

namespace App\Http\Repository\Product\Read;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface ProductReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection;
    public function getById(int $id): EloquentCollection;
}
