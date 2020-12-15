<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\Order;
interface OrderRepositoryInterface{

    public function findAll() : array;

    public function findById(int $id) : Order;

    public function create(Order $order) : bool;

    public function update(Order $order) : bool;

    public function delete(int $id) : bool;
}


?>
