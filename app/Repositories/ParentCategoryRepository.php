<?php

namespace App\Repositories;

use App\Contracts\Repositories\ParentCategoryRepositoryInterface;
use App\Models\ParentCategory;
use Illuminate\Http\Request;

class ParentCategoryRepository implements  ParentCategoryRepositoryInterface
{


    public function getAll()
    {
        return ParentCategory::all();
    }

    public function create($request = [])
    {
        return ParentCategory::create([
            'name' => $request['name'],
        ]);
    }

    public function update($request = [], $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }
}
