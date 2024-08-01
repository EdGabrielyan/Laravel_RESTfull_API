<?php

namespace App\Http\Action\User;

use App\Events\RegisterProcessed;
use App\Http\Repository\User\Read\UserReadRepositoryInterface;
use App\Http\Repository\User\Write\UserWriteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

class UserAction
{
    public function __construct(
        protected UserWriteRepositoryInterface $userWriteRepository,
        protected UserReadRepositoryInterface  $userReadRepository
    )
    {
    }

    public function storeData(Collection $data): EloquentCollection
    {
        $result = $this->userWriteRepository->save($data);
        RegisterProcessed::dispatch($result->get('email'), $result->get('name'));
        return $result;
    }

    public function getData(Collection $data): EloquentCollection
    {
        return $this->userReadRepository->get($data);
    }

    public function getDataById(int $id): EloquentCollection
    {
        return $this->userReadRepository->getById($id);
    }

    public function updateData(Collection $data): EloquentCollection
    {
        return $this->userWriteRepository->update($data);
    }

    public function deleteData()
    {
        return $this->userWriteRepository->delete();
    }
}
