<?php

namespace App\Contracts\Repositories;

use Illuminate\Http\Request;

interface ProductRepositoryInterface extends  AbstractRepositoryInterface
{
    public function updateStatus($id, $status);

    public function  findProduct($id);

}
