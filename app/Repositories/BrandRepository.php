<?php

namespace App\Repositories;

use App\Contracts\Repositories\BrandRepositoryInterface;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandRepository implements BrandRepositoryInterface
{


    public function getAll()
    {
       return Brand::all();
    }

    public function create($request = [])
    {
        try{
            Brand::create([
                'name' => $request->name
            ]);
        }
        catch (\Exception $err)
        {
            return false;
        }
        return true;
    }

    public function update($request = [], $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->save();
        return true;
    }

    public function destroy($id)
    {
        return $author = Brand::find($id)->delete();
    }
    public function find($id)
    {
        return Brand::find($id);
    }
}
