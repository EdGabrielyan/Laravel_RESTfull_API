<?php

namespace App\Http\Action\Category;

use App\Http\Repository\Category\Read\CategoryReadRepositoryInterface;
use App\Http\Repository\Category\Write\CategoryWriteRepositoryInterface;
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

    public function storeData(Collection $data): EloquentCollection
    {
        return $this->categoryWriteRepository->save($data);
    }
}
