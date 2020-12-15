<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\Category;

interface CategoryRepositoryInterface
{
    public function findAll() : array;

    public function findById(int $id) : Category;

    public function create(Category $category) : bool;

    public function update(Category $category) : bool;

    public function delete(int $id) : bool;
}