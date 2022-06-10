<?php

namespace App\Repositories;

use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\False_;

class AuthorRepository implements AuthorRepositoryInterface
{

    public function getAll()
    {
         return Author::all();
    }


    public function create($request = [])
    {

        try{
            Author::create([
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
        $author = Author::find($id);
        $author->name = $request->name;
        $author->save();
        return true;
    }

    public function destroy($id)
    {
        return $author = Author::find($id)->delete();

    }

    public function find($id)
    {
        return Author::find($id);
    }
}
