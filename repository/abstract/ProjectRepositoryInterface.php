<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\Project;
interface ProjectRepositoryInterface{

    public function findAll() : array;

    public function findById(int $id) : ?Project;

    public function create(Project $p) : bool;

    public function update(Project $p) : bool;

    public function delete(int $id) : bool;

    public function findByOrdersId(int $orders_id) : ?Project;

    public function fromStringArray(array $res) : Project;
}


?>
