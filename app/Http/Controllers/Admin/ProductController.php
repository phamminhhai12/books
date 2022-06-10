<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AuthorRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Media;
use App\Models\Brand;
use App\Models\Author;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $productRepository;
    protected $authorRepository;
    protected $brandRepository;
    protected  $categoryRepository;
    protected $supllierRepository;

    public function __construct(ProductRepository  $productRepository, AuthorRepository  $authorRepository, BrandRepository $brandRepository,CategoryRepository $categoryRepository, SupplierRepository  $supllierRepository)
    {
        $this->productRepository = $productRepository;
        $this->authorRepository= $authorRepository;
        $this->brandRepository = $brandRepository;
        $this->supllierRepository = $supllierRepository;
        $this->categoryRepository= $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return view('admin.products.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAll();
        $suppliers = $this->supllierRepository->getAll();
        $authors = $this->authorRepository->getAll();
        $brands = $this->brandRepository->getAll();
        return view('admin.products.add', compact('categories', 'suppliers', 'authors', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request = [])
    {

            $product = $this->productRepository->create($request);
            foreach($request->thumbnail as $image) {
                $name = $image->getClientOriginalName();
                $image->storeAs('/public/images/products', $name);
                $product->image()->create(["url" => "storage/images/products/". $name]);
            }
            return $product;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->getAll();
        $suppliers = $this->supllierRepository->getAll();
        $authors = $this->authorRepository->getAll();
        $brands = $this->brandRepository->getAll();
        $product = $this->productRepository->find($id);
        return view('admin.products.edit', compact('categories', 'suppliers', 'product', 'authors', 'brands'));
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

        $product = $this->productRepository->find($id);
        $delete_images_src = [];
        if($request->has('thumbnail_src')) {
            foreach($product->image as $product_thumbnail_src) {
                $is_delete = true;
                foreach($request->thumbnail_src as $request_thumbnail_src) {
                    if(trim($product_thumbnail_src->url) == trim($request_thumbnail_src)) {
                        $is_delete = false;
                        break;
                    }
                }
                if($is_delete) {
                    array_push($delete_images_src, $product_thumbnail_src->url);
                }
            }
        } else {
            foreach($product->image as $product_thumbnail_src) {
                array_push($delete_images_src, $product_thumbnail_src->url);
            }
        }
        Media::whereIn("url", $delete_images_src)->delete();
        foreach($delete_images_src as $product_thumbnail_src) {
            Storage::delete("images/products/$product_thumbnail_src");
        }
        if($request->has('thumbnail')) {
            foreach($request->thumbnail as $image) {
                $name = $image->getClientOriginalName();
                $image->storeAs('/public/images/products', $name);
                $product->image()->create(["url" => "storage/images/products/". $name]);
            }
        }
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->supplier_id = $request->input('supplier_id');
        $product->author_id = $request->input('author_id');
        $product->brand_id = $request->input('brand_id');
        $product->description = $request->input('description');
        $product->qty = $request->input('qty');
        $product->public_date = $request->public_date;
        $product->size = $request->size;
        $product->cover = $request->cover;
        $product->page = $request->page;
        $product->save();
        return redirect()->route('product.list')->with("success","Sửa thành công");
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepository->destroy(id);
        return redirect()->route('product.list')->with("success","Xóa thành công");
    }

    public function updateStatus($id, $status)
    {
        $this->productRepository->update($id,$status);
        return redirect()->route('product.list')->with("success","Cập nhật trạng thái thành công");
    }

    public function show($id)
    {
        $product = $this->productRepository->findProduct($id);
        return view('admin.products.show', compact('product'));
    }
}
