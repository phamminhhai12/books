@extends('client.layout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/product-item.css') }}">
@endsection

@section('content')
    <!-- breadcrumb  -->
    <section class="breadcrumbbar">
        <div class="container">
            <div class="container">
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('product.category', ['id' => $product->category_id]) }}">{{ \App\Models\Category::find($product->category_id)->name }}</a></li>
                    <li class="breadcrumb-item active"><a href="{{ route('product.detail', ['id' => $product->id]) }}">{{ $product->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- nội dung của trang  -->
    <section class="product-page mb-4">
        <div class="container">
            <!-- chi tiết 1 sản phẩm -->
            <div class="product-detail bg-white p-4">
                <div class="row">
                    <!-- ảnh  -->
                    <div class="col-md-5 khoianh">
                        <div class="anhto mb-4">
                            <a class="active" href="{{ asset($product->image->first()->url) }}"
                                data-fancybox="thumb-img">
                                <img class="product-image"
                                    src="{{ asset($product->image->first()->url) }}"
                                    alt="{{ $product->name }}" style="width: 100%;">
                            </a>
                            <a href="{{ asset($product->image->first()->url) }}" data-fancybox="thumb-img"></a>
                        </div>
                        <div class="list-anhchitiet d-flex mb-4" style="margin-left: 2rem;">
                            @foreach($product->image as $item)
                                <img class="thumb-img thumb1 mr-3"
                                    src="{{ asset($item->url) }}"
                                    class="img-fluid">
                            @endforeach
                        </div>
                    </div>
                    <!-- thông tin sản phẩm: tên, giá bìa giá bán tiết kiệm, các khuyến mãi, nút chọn mua.... -->
                    <div class="col-md-7 khoithongtin">
                        <div class="row">
                            <div class="col-md-12 header">
                                <h4 class="ten">{{ $product->name }}</h4>
                            </div>
                            <div class="col-md-7">
                                <div class="gia">
                                    <div class="giaban text-danger" style="font-size: 20px;">Giá bán: {{ number_format($product->price,-3,',',',') }} VND</div>
                                </div>
                                <div class="soluong d-flex">
                                    <label class="font-weight-bold">Số lượng: </label>
                                    <div class="input-number input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn-spin btn-dec">-</span>
                                        </div>
                                        <input type="text" value="1" class="soluongsp  text-center">
                                        <div class="input-group-append">
                                            <span class="input-group-text btn-spin btn-inc">+</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nutmua btn w-100 text-uppercase">Thêm giỏ hàng</div>
                            </div>
                            <!-- thông tin khác của sản phẩm:  tác giả, ngày xuất bản, kích thước ....  -->
                            <div class="col-md-5">
                                <div class="thongtinsach">
                                    <ul>
                                        <li>Tác giả: <a href="javascript:void(0)" class="tacgia">{{ \App\Models\Author::find($product->author_id)->name }}</a></li>
                                        @if ($product->public_date)
                                            <li>Ngày xuất bản: <b>{{ date('d/m/Y', strtotime($product->public_date)) }}</b></li>
                                        @endif
                                        <li>Hãng sách: {{ \App\Models\Brand::find($product->brand_id)->name }}</li>
                                        @if ($product->size)
                                            <li>Kích thước: <b>{{ $product->size }}</b></li>
                                        @endif
                                        <li>Nhà xuất bản: {{ \App\Models\Supplier::find($product->supplier_id)->name }}</li>
                                        @if ($product->cover)
                                            <li>Hình thức bìa: <b>{{ $product->cover }}</b></li>
                                        @endif
                                        @if ($product->page)
                                            <li>Số trang: <b>{{ $product->page }}</b></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- decripstion của 1 sản phẩm: giới thiệu , đánh giá độc giả  -->
                    <div class="product-description col-md-9">
                        <!-- 2 tab ở trên  -->
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active text-uppercase" id="nav-gioithieu-tab" data-toggle="tab"
                                    href="#nav-gioithieu" role="tab" aria-controls="nav-gioithieu" aria-selected="true">Giới
                                    thiệu</a>
                            </div>
                        </nav>
                        <!-- nội dung của từng tab  -->
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active ml-3" id="nav-gioithieu" role="tabpanel"
                                aria-labelledby="nav-gioithieu-tab">
                                <h6 class="tieude font-weight-bold">{{ $product->name }}</h6>
                                {!! $product->description !!}
                            </div>
                            <!-- het tab nav-danhgia  -->
                        </div>
                        <!-- het tab-content  -->
                    </div>
                    <!-- het product-description -->
                </div>
                <!-- het row  -->
            </div>
            <!-- het product-detail -->
        </div>
        <!-- het container  -->
    </section>
    <!-- het product-page -->

    <!-- khối sản phẩm tương tự -->
    <section class="_1khoi sachmoi">
        <div class="container">
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-light pt-4">
                        <h5 class="header text-uppercase" style="font-weight: 400;">Sản phẩm liên quan</h5>
                        <a href="{{ route('product.category', ['id' => $product->category_id]) }}" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                </div>
                <div class="khoisanpham" style="padding-bottom: 2rem;">
                    @foreach (\App\Models\Product::where('category_id', $product->category_id)->where('id', '<>', $product->id)->orderBy('id', 'DESC')->get() as $product)
                        <!-- 1 sản phẩm -->
                        <div class="card">
                            <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="motsanpham"
                                style="text-decoration: none; color: black;" data-toggle="tooltip"
                                data-placement="bottom" title="{{ $product->name }}">
                                <img class="card-img-top anh" src="{{ asset($product->image->first()->url) }}"
                                    alt="{{ $product->name }}">
                                <div class="card-body noidungsp mt-3 text-center">
                                    <h6 class="card-title ten">{{ $product->name }}</h6>
                                    <small class="tacgia text-muted">{{ \App\Models\Author::find($product->author_id)->name }}</small>
                                    <div class="gia">
                                        <div class="giamoi text-center">{{ number_format($product->price,-3,',',',') }} VND</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
