<?php

namespace App\Http\Repository\User\Read;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface UserReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection;
    public function getById(int $id): EloquentCollection;
}
