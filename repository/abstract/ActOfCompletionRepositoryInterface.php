<?php

namespace Repository\abstract;
use Model\ActOfCompletion;


interface ActOfCompletionRepositoryInterface
{
    public function findAll() : array;

    public function findById(int $id) : ActOfCompletion;

    public function create(ActOfCompletion $actOfCompletion) : bool;

    public function update(ActOfCompletion $actOfCompletion) : bool;

    public function delete(int $id) : bool;

}