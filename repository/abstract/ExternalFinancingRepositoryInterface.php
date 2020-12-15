<?php

declare(strict_types=1);

namespace Repository\abstract;
use Model\ExternalFinancing;
interface ExternalFinancingRepositoryInterface
{
    public function findAll() : array;

    public function findById(int $id) : ExternalFinancing;

    public function create(ExternalFinancing $externalFinancing) : bool;

    public function update(ExternalFinancing $externalFinancing) : bool;

    public function delete(int $id) : bool;
}