<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\PartOfTask;

interface PartOfTaskRepositoryInterface
{
    public function findAll() : array;

    public function findById(int $id) : PartOfTask;

    public function create(PartOfTask $partOfTask) : bool;

    public function update(PartOfTask $partOfTask) : bool;

    public function delete(int $id) : bool;
}