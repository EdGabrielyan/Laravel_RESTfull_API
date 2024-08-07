<?php

namespace App\Http\Repository\User\Read;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class UserReadRepository implements UserReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection
    {
        return User::Has('products')->offset($data->get('offset'))->limit($data->get('limit'))->get();
    }

    public function getById(int $id): EloquentCollection
    {
        $user = User::Has('products')->findOrFail($id);

        return EloquentCollection::make($user);
    }
}
