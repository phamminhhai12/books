<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParentCategory;
use App\Models\Product;
use App\Repositories\AuthorRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ParentCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class PrController extends Controller
{
    protected $productRepository;
    protected $authorRepository;
    protected $brandRepository;
    protected  $categoryRepository;
    protected $supllierRepository;
    protected $parentCategoryRepository;

    public function __construct(ProductRepository  $productRepository, AuthorRepository  $authorRepository, BrandRepository $brandRepository,CategoryRepository $categoryRepository, SupplierRepository  $supllierRepository, ParentCategoryRepository $parentCategoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->authorRepository= $authorRepository;
        $this->brandRepository = $brandRepository;
        $this->supllierRepository = $supllierRepository;
        $this->categoryRepository= $categoryRepository;
        $this->parentCategoryRepository = $parentCategoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name'=> $request->input('name'),
            'price'=>$request->input('price')
        ];
       return $request;

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
        return response(
            [
                'category'=> $categories,
                'suppliers'=> $suppliers,
                'authors' => $authors,
                'brand' => $brands
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->productRepository->findProduct($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
