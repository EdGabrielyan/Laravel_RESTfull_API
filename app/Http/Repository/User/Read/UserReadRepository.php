<?php

namespace App\Http\Repository\User\Read;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class UserReadRepository implements UserReadRepositoryInterface
{
    public function get(Collection $data): EloquentCollection
    {
        return User::Has('products')->with('products:id,name,user_id')->offset($data->get('offset'))->limit($data->get('limit'))->get();
    }

    public function getById(int $id): EloquentCollection
    {
        $user = User::Has('products')->with('products:id,name,user_id')->findOrFail($id);

        return EloquentCollection::make($user);
    }

    public function getByName(string $name): EloquentCollection
    {
        $user = User::where('name', 'like', "___{$name}%")->get();

        return EloquentCollection::make($user);
    }
}
