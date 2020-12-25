<?php
declare(strict_types=1);

namespace Repository\abstract;
use Model\Investor;
interface InvestorRepositoryInterface{

    public function findAll() : array;

    public function findById(int $id) : ?Investor;

    public function create(Investor $investor) : bool;

    public function update(Investor $investor) : bool;

    public function delete(int $id) : bool;
    public function fromStringArray(array $res) : Investor;
}


?>
