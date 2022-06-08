@extends('client.layout.master')
@section('content')
    @foreach ($parentCategories as $parentCategory)
        @php
            $products = \App\Models\Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->join('authors', 'products.author_id', '=', 'authors.id')
            ->where('categories.parent_category_id', $parentCategory->id)
            ->orderBy('products.id', 'DESC')
            ->get(['products.*', 'authors.name AS author_name']);
        @endphp
        @if ($products->count() > 0)
            <!-- khoi sach moi  -->
            <section class="_1khoi sachmoi bg-white">
                <div class="container">
                    <div class="noidung" style=" width: 100%;">
                        <div class="row">
                            <!--header-->
                            <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-transparent pt-4">
                                <h1 class="header text-uppercase" style="font-weight: 400;">{{ $parentCategory->name }}</h1>
                                <a href="{{ route('products', ['id' => $parentCategory->id]) }}" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                            </div>
                        </div>
                        <div class="khoisanpham" style="padding-bottom: 2rem;">
                            @foreach ($products as $product)
                                <!-- 1 san pham -->
                                <div class="card">
                                    <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="motsanpham"
                                        style="text-decoration: none; color: black;" data-toggle="tooltip" data-placement="bottom"
                                        title="{{ $product->name }}">
                                        <img class="card-img-top anh"
                                            src="{{ asset($product->image->first()->url) }}"
                                            alt="{{ $product->name }}">
                                        <div class="card-body noidungsp mt-3">
                                            <h3 class="card-title ten">{{ $product->name }}</h3>
                                            <small class="tacgia text-muted">{{ $product->author_name }}</small>
                                            <div class="gia d-flex align-items-baseline">
                                                <div class="giamoi">{{ number_format($product->price,-3,',',',') }} VND</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    <!-- div _1khoi -- khoi sachnendoc -->
    <section class="_1khoi sachnendoc bg-white mt-4">
        <div class="container">
            <div class="noidung" style=" width: 100%;">
                <div class="row">
                    <!--header-->
                    <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-transparent pt-4">
                        <h2 class="header text-uppercase" style="font-weight: 400;">SÁCH MỚI ĐĂNG GẦN ĐÂY</h2>
                        <a href="{{ route('product.new') }}" class="btn btn-warning btn-sm text-white">Xem tất cả</a>
                    </div>
                    @foreach (\App\Models\Product::orderBy('id', 'DESC')->get() as $product)
                        <!-- 1 san pham -->
                        <div class="col-lg col-sm-4">
                            <div class="card">
                                <a href="{{ route('product.detail', ['id' => $product->id]) }}" class="motsanpham" style="text-decoration: none; color: black;"
                                    data-toggle="tooltip" data-placement="bottom"
                                    title="{{ $product->name }}">
                                    <img class="card-img-top anh"
                                        src="{{ asset($product->image->first()->url) }}"
                                        alt="tung-buoc-chan-no-hoa">
                                    <div class="card-body noidungsp mt-3">
                                        <h3 class="card-title ten">{{ $product->name }}</h3>
                                        <small class="thoigian text-muted">{{ date('d/m/Y', strtotime($product->created_at)) }}</small>
                                        <div><a class="detail" href="{{ route('product.detail', ['id' => $product->id]) }}">Xem chi tiết</a></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
        </div>
    </section>
@endsection
