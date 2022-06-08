@extends('admin.layouts.index')


@section('content')
<h1 class="h3 mb-2 text-gray-800">Chi tiết đơn hàng</h1>

<form method="POST" action="{{ route('order.edit', ['id' => $order->id_donhang]) }}" style="margin-bottom: 3rem;">
    @csrf
    <select name="status" class="status" style="padding:0.4rem 0;outline:none;">
        @if ($order->tinhtrang === 0)
            <option value="0" selected>Chờ xác nhận</option>
            <option value="1">Xác nhận</option>
            <option value="3">Hủy đơn hàng</option>
        @elseif ($order->tinhtrang === 1)
            <option value="1" selected>Xác nhận</option>
            <option value="2">Hoàn thành</option>
        @elseif ($order->tinhtrang === 2)
            <option value="2" selected>Hoàn thành</option>
        @else
            <option value="3" selected>Hủy đơn hàng</option>
        @endif
    </select>
    @if (($order->tinhtrang === 0) || ($order->tinhtrang === 1))
    <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
    @endif
</form>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @foreach ($orders_detail as $row)
                        <tr class="even gradeC" align="center">
                            <td>{{ $row->ten_sp }}</td>
                            <td>{{ $row->soluong }}</td>
                            <td>{{ number_format((strtotime(date('Y-m-d')) < strtotime($row->thoigianbatdau) || strtotime(date('Y-m-d')) > strtotime($row->thoigianketthuc)) ? $row->giatien : $row->giakhuyenmai,-3,',',',') }} VND</td>
                            <td>{{ number_format((strtotime(date('Y-m-d')) < strtotime($row->thoigianbatdau) || strtotime(date('Y-m-d')) > strtotime($row->thoigianketthuc)) ? $row->giatien * $row->soluong : $row->giakhuyenmai * $row->soluong,-3,',',',') }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
