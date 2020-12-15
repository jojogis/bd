<?php


declare(strict_types=1);

namespace Repository\abstract;

use Model\Programmer;

interface ProgrammerRepositoryInterface
{
    public function findAll() : array;

    public function findById(int $id) : Programmer;

    public function create(Programmer $programmer) : bool;

    public function update(Programmer $programmer) : bool;

    public function delete(int $id) : bool;

}
