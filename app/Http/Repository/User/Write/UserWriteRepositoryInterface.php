<?php

namespace App\Http\Repository\User\Write;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

interface UserWriteRepositoryInterface
{
    public function save(Collection $data): EloquentCollection;

    public function update(Collection $data): EloquentCollection;

    public function delete();
}
