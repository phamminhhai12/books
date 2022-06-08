@extends('client.layout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('client/css/sach-moi-tuyen-chon.css') }}">
@endsection

@section('content')
    <!-- các sản phẩm  -->
    <section class="content my-4">
        <div class="container">
            <div class="noidung bg-white" style=" width: 100%;">
                <div class="col-12 d-flex justify-content-between align-items-center pb-2 bg-transparent pt-4">
                    <p class="header text-uppercase" style="font-size:20px">Tìm kiếm theo từ khóa: {{ $q }}</p>
                </div>
                <div class="items">
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-4 col-xs-6">
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
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- pagination bar  -->
                <div class="pagination-bar my-3">
                    <div class="row">
                        <div class="col-12">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>

                <!--het khoi san pham-->
            </div>
            <!--het div noidung-->
        </div>
        <!--het container-->
    </section>
@endsection
