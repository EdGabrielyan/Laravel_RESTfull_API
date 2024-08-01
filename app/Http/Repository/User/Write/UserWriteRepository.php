<?php

namespace App\Http\Repository\User\Write;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    public function save(Collection $data): EloquentCollection
    {
        $user = User::create($data->toArray());

        return EloquentCollection::make($user);
    }

    public function update(Collection $data): EloquentCollection
    {
        $user = Auth::user();

        $user->update([
            'name' => $data->get('name'),
            'password' => bcrypt($data->get('password'))
        ]);

        return EloquentCollection::make($user);
    }

    public function delete(): void
    {
        $user = Auth::user();
        $user->delete();
    }
}
