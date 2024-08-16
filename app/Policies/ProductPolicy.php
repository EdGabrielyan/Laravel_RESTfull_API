<?php

namespace App\Policies;

use Illuminate\Support\Collection;

class ProductPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(Collection $data): bool
    {
        return auth()->id() == $data->get('user_id');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Collection $data): bool
    {
        return auth()->id() === $data->get('user_id');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return true;
    }
}
