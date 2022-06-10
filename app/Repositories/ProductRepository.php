<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository implements ProductRepositoryInterface
{


    public function getAll()
    {
        return Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->join('authors', 'products.author_id', '=', 'authors.id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->get(['products.*', 'categories.name AS cate_title', 'suppliers.name AS supplier_title', 'authors.name AS author_title', 'brands.name AS brand_title']);
    }

    public function create($request = [])
    {
        Product::create([
            'name' => $request->input(['name']),
            'price' => $request->input('price'),
            'category_id' => $request->input(['category_id']),
            'supplier_id' => $request->input(['supplier_id']),
            'author_id' => $request->author_id,
            'brand_id' => $request->brand_id,
            'description' => $request->input('description'),
            'qty' => $request->input('qty'),
            'public_date' => $request->public_date,
            'size' => $request->size,
            'cover' => $request->cover,
            'page' => $request->page
        ]);
    }

    public function update($request = [], $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function updateStatus($id, $status)
    {
        $product = Product::find($id);
        $product->status = $status;
        $product->save();
    }

    public function findProduct($id)
    {
        return Product::where('id',$id)
            -> join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->join('authors', 'products.author_id', '=', 'authors.id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->get(['products.*', 'categories.name AS cate_title', 'suppliers.name AS supplier_title', 'authors.name AS author_title', 'brands.name AS brand_title']);
    }
}
