<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\Task;
interface TaskRepositoryInterface{
    public function findAll() : array;

    public function findById(int $id) : Task;

    public function create(Task $task) : bool;

    public function update(Task $task) : bool;

    public function delete(int $id) : bool;
}
