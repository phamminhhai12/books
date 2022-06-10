<?php

namespace App\Repositories;

use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentRepository implements CommentRepositoryInterface
{


    public function getAll()
    {
        return Comment::all();
    }

    public function create($request = [])
    {
        // TODO: Implement create() method.
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
