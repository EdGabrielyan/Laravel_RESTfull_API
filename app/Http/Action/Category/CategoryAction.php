<?php

namespace App\Http\Action\Category;

use App\Http\Repository\Category\Read\CategoryReadRepositoryInterface;
use App\Http\Repository\Category\Write\CategoryWriteRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CategoryAction
{
    public function __construct (
        protected CategoryReadRepositoryInterface $categoryReadRepository,
        protected CategoryWriteRepositoryInterface  $categoryWriteRepository,
    )
    {
    }

    public function getData(Collection $data): EloquentCollection
    {
        return $this->categoryReadRepository->get($data);
    }

    public function storeData(Collection $data): EloquentCollection
    {
        return $this->categoryWriteRepository->save($data);
    }

    public function getDataById(int $id): EloquentCollection
    {
        return $this->categoryReadRepository->getById($id);
    }

    public function updateData(Collection $data, int $id): EloquentCollection
    {
        return $this->categoryWriteRepository->update($data, $id);
    }

    public function deleteData(int $id)
    {
        return $this->categoryWriteRepository->delete($id);
    }
}
