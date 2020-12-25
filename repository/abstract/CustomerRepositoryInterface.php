<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\Customer;
interface CustomerRepositoryInterface{

    public function findAll() : array;

    public function findById(int $id) : ?Customer;

    public function create(Customer $customer) : bool;

    public function update(Customer $customer) : bool;

    public function delete(int $id) : bool;
    public function fromStringArray(array $res) : Customer;
}


?>
