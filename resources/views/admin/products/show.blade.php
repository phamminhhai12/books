@extends('admin.layouts.index')


@section('content')
<h1 class="h3 mb-2 text-gray-800">Chi tiết sản phẩm</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <tr>
                    <th>Ảnh sản phẩm</th>
                    <td>
                        <div class="row">
                            @foreach($product->image as $item)
                                <div class="col-md-4">
                                    <img src="{{ asset($item->url) }}" width="200" height="200">
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Tên sản phẩm</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>Giá tiền</th>
                    <td>{{ number_format($product->price,-3,',',',') . ' VND'; }}</td>
                </tr>
                <tr>
                    <th>Mô tả sản phẩm</th>
                    <td>{!! $product->description ?? 'Không có' !!}</td>
                </tr>
                <tr>
                    <th>Danh mục sản phẩm</th>
                    <td>{{ $product->cate_title }}</td>
                </tr>
                <tr>
                    <th>Hãng sản phẩm</th>
                    <td>{{  $product->braand_title}}</td>
                </tr>
                <tr>
                    <th>Tác giả</th>
                    <td>{{  $product->author_title }}</td>
                </tr>
                <tr>
                    <th>Nhà xuất bản</th>
                    <td>{{  $product->supllier_title }}</td>
                </tr>
                <tr>
                    <th>Số lượng</th>
                    <td>{{ $product->qty }}</td>
                </tr>
                <tr>
                    <th>Ngày xuất bản</th>
                    <td>{{ date('d/m/Y', strtotime($product->public_date)) ?? 'Chưa xác định' }}</td>
                </tr>
                <tr>
                    <th>Kích thước</th>
                    <td>{{ $product->size ?? 'Chưa xác định' }}</td>
                </tr>
                <tr>
                    <th>Hình thức bìa</th>
                    <td>{{ $product->cover ?? 'Chưa xác định' }}</td>
                </tr>
                <tr>
                    <th>Số trang</th>
                    <td>{{ $product->page }}</td>
                </tr>
                <tr>
                    <th>Trạng thái</th>
                    <td>{{ $product->status == 1 ? 'Hiện' : 'Ẩn' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
