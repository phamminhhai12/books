<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ParentCategoryRepository;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ParentCategory;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $parentCategoryRepository;

    public function __construct(CategoryRepository $categoryRepository, ParentCategoryRepository  $parentCategoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->parentCategoryRepository = $parentCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAllCategory();
        return view('admin.categories.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentCategories = $this->parentCategoryRepository->getAll();
        return view('admin.categories.add', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                $request->image->storeAs('/public/images/categories', $request->image->getClientOriginalName());
                $this->categoryRepository->create($request);
                return redirect()->route('category.list')->with("success","Lưu thành công");
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parentCategories = $this->parentCategoryRepository->getAll();
        $category = $this->categoryRepository->find($id);
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->categoryRepository->update($request,$id);
        return redirect()->route('category.list')->with("success","Sửa thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->categoryRepository->destroy($id);
        return redirect()->route('category.list')->with("success","Xóa thành công");
    }
}
