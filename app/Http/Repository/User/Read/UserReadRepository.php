<?php

namespace App\Http\Repository\User\Read;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class UserReadRepository implements UserReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection
    {
        return User::offset($data->get('offset'))->limit($data->get('limit'))->get();
    }

    public function getById(int $id): EloquentCollection
    {
        $user = User::findOrFail($id);

        return EloquentCollection::make($user);
    }
}
