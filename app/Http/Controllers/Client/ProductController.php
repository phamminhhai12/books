<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ParentCategory;
use App\Models\Author;
use App\Models\Product;

class ProductController extends Controller
{
    public function showProducts($id)
    {
        $parentCategory = ParentCategory::find($id);
        $categories = Category::where('parent_category_id', $id)->get();
        return view('client.products', compact('categories', 'parentCategory'));
    }

    public function showNewProduct()
    {
        $products = Product::orderBy('id','DESC')->paginate(12);
        return view('client.product-new', compact('products'));
    }

    public function showProductCategory($id)
    {
        $category = Category::find($id);
        $products = Product::where('category_id', $id)->orderBy('id', 'DESC')->paginate(12);
        $authors = Author::all();
        return view('client.product-category', compact('category', 'products', 'authors'));
    }

    public function showProductDetail($id)
    {
        $product = Product::find($id);
        return view('client.product-detail', compact('product'));
    }

    public function showProductSearch(Request $request)
    {
        $q = $request->q;
        if ($q) {
            $products = Product::where('name', 'like', '%' . $q . '%')->orderBy('id', 'DESC')->paginate(12);
        } else {
            $products = Product::orderBy('id', 'DESC')->paginate(12);
        }
        return view('client.product-search', compact('products', 'q'));
    }

    public function sort(Request $request)
    {
        if ($request->sort == 0) {
            $products = Product::orderBy('id', 'DESC')->where('category_id', $request->category_id)->paginate(12);
        } elseif ($request->sort == 1) {
            $products = Product::orderBy('price','ASC')->where('category_id', $request->category_id)->paginate(12);
        } else {
            $products = Product::orderBy('price','DESC')->where('category_id', $request->category_id)->paginate(12);
        }
        return response()->json([
            'status' => 200,
            'data'   => view('client.includes.product-category', compact('products'))->render()
        ]);
    }

    public function filter(Request $request)
    {
        if ($request->id != 0) {
            $products = Product::orderBy('id', 'DESC')->where('category_id', $request->category_id)->where('author_id',$request->id)->paginate(12);
        } else {
            $products = Product::orderBy('id', 'DESC')->where('category_id', $request->category_id)->paginate(12);
        }
        return response()->json([
            'status' => 200,
            'data'   => view('client.includes.product-category', compact('products'))->render()
        ]);
    }
}
