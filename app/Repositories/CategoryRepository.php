<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\ParentCategory;
use Illuminate\Http\Request;

class CategoryRepository implements CategoryRepositoryInterface
{


    public function getAll()
    {
        return Category::all();
    }

    public function getAllCategory()
    {
        return Category:: join('parent_categories','categories.parent_category_id','parent_categories.id')
                            -> select('categories.id as id','categories.name as name','categories.url as url',
                                'parent_categories.name as parent_category_name','parent_categories.id as parent_category_id ')
                            ->get();
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
