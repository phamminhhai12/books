@extends('admin.layouts.index')


@section('content')
<h1 class="h3 mb-2 text-gray-800">Đơn hàng</h1>

@if(Session::has('invalid'))
    <div class="alert alert-danger alert-dismissible">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{Session::get('invalid')}}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
            <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{Session::get('success')}}
    </div>
@endif
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Mã khuyến mãi</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Mã khuyến mãi</th>
                        <th>Ngày đặt hàng</th>
                        <th>Trạng thái</th>
                        <th>Chức năng</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    @foreach ($orders as $row)
                        <tr>
                            <td>{{ $row->id_donhang }}</td>
                            <td>{{ $row->hoten }}</td>
                            <td>{{ !is_null($row->id_khuyenmai) ? number_format($row->thanhtien - \App\Models\Voucher::find($row->id_khuyenmai)->giatien,-3,',',',') : number_format($row->thanhtien,-3,',',',') }} VND</td>
                            <td>{{ !is_null($row->id_khuyenmai) ? \App\Models\Voucher::find($row->id_khuyenmai)->makhuyenmai : 'Không có' }}</td>
                            <td>{{ date('d/m/Y H:i:s',strtotime($row->created_at)) }}</td>
                            <td>
                                @if ($row->tinhtrang === 0)
                                    {{ 'Chờ xác nhận' }}
                                @elseif ($row->tinhtrang === 1)
                                    {{ 'Xác nhận' }}
                                @elseif ($row->tinhtrang === 2)
                                    {{ 'Hoàn thành' }}
                                @elseif ($row->tinhtrang === 3)
                                    {{ 'Hủy' }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.show',['id' => $row->id_donhang]) }}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('order.print',['id' => $row->id_donhang]) }}" class="btn btn-warning btn-circle btn-sm" target="_blank">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
