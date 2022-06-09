<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{


    public function getAll()
    {
        return Category::all();
    }

    public function create(Request $request)
    {
         Category::create([
            'name' => $request->name,
            'parent_category_id' => $request->parent_category_id,
            'url' => "storage/images/categories/". $request->image->getClientOriginalName()
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_category_id = $request->parent_category_id;
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/categories', $request->image->getClientOriginalName());
                $category->url = "storage/images/categories/". $request->image->getClientOriginalName();
            }
        }
        $category->save();
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
    }

    public function find($id)
    {
        return Category::find($id);
    }
}
