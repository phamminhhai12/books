<?php

namespace App\Contracts\Repositories;

use Illuminate\Http\Request;

interface AbstractRepositoryInterface
{
    public function getAll();

    public function create( $request = []);

    public function  update($request = [], $id);

    public function destroy($id);

    public function find($id);



}
