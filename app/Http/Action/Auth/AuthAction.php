<?php

namespace App\Http\Action\Auth;

use App\Exceptions\NotFoundException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AuthAction
{
    /**
     * @throws NotFoundException
     */
    public function generateToken(Collection $data): EloquentCollection
    {

        if (Auth::attempt($data->toArray())) {
            $token = auth()->user()->createToken('auth_token')->plainTextToken;
            return EloquentCollection::make(['token' => $token]);
        } else {
            throw new NotFoundException;
        }
    }



    public function logout()
    {
        auth()->user()->token()->delete();
        return response()->json(['message' => 'Successfully logged out']);
    }
}
