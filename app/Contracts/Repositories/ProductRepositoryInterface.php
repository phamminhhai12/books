<?php

namespace App\Contracts\Repositories;

interface ProductRepositoryInterface extends  AbstractRepositoryInterface
{
    public function updateStatus($id, $status);

    public function  findProduct($id);
}
