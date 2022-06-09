<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{

    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors =  $this->authorRepository->getAll();
        return view('admin.authors.list', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.authors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        Author::create([
//            'name' => $request->name
//        ]);
        $result = $this->authorRepository->create($request);
        if($result){
            return redirect()->route('author.list')->with("success","Lưu thành công");
        }
        else{
            return redirect()->route('author.list')->with("error","Lưu thất bại");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = $this->authorRepository->find($id);
        return view('admin.authors.edit', compact('author'));
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
//        $author = Author::find($id);
//        $author->name = $request->name;
//        $author->save();
        $result = $this->authorRepository->update($request, $id);
        if($result){
            return redirect()->route('author.list')->with("success","Sửa thành công");
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->authorRepository->destroy($id);
        if($result){
            return redirect()->route('author.list')->with("success","Xóa thành công");
        }
    }
}
