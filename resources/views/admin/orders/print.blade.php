<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $order->id_donhang }}</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/css/invoice.css') }}" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="page-content container">
    <div class="page-header text-blue-d2">
        <div class="page-tools">
            <div class="action-buttons" id="printPageButton">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" onclick="window.print()">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    In pdf
                </a>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-10 offset-lg-1">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <span class="text-default-d3">TRE VIỆT NAM</span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Thông tin khách hàng
                            </div>
                        </div>
                        @php
                            $user = \App\Models\User::find($order->id_nguoidung);
                        @endphp
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">Khách hàng:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{ $user->hoten }}</span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                Số điện thoại: {{ $user->sdt }}
                            </div>
                            <div class="my-1">
                                Địa chỉ: {{ $order->diachi }}
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Hóa đơn
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Mã đơn hàng:</span> {{ $order->id_donhang }}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Ngày thanh toán:</span> {{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Trạng thái:</span>
                                @if ($order->tinhtrang == 1)
                                    <span class="badge badge-primary badge-pill px-25">
                                    Xác nhận
                                @elseif ($order->tinhtrang == 2) 
                                    <span class="badge badge-success badge-pill px-25">
                                    Hoàn thành
                                @elseif ($order->tinhtrang == 3)
                                    <span class="badge badge-danger badge-pill px-25">
                                    Hủy
                                @else 
                                    <span class="badge badge-secondary badge-pill px-25">
                                    Chờ xác nhận
                                @endif
                            </span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Sản phẩm</div>
                        <div class="d-none d-sm-block col-4 col-sm-2">Số lượng</div>
                        <div class="d-none d-sm-block col-sm-2">Đơn giá</div>
                        <div class="col-2">Tổng</div>
                    </div>

                    <div class="text-95 text-secondary-d3">
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($orders_detail as $product)
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1">{{ $count }}</div>
                                <div class="col-9 col-sm-5">{{ $product->ten_sp }}</div>
                                <div class="d-none d-sm-block col-2">{{ $product->soluong }}</div>
                                <div class="d-none d-sm-block col-2 text-95">{{ number_format((strtotime(date('Y-m-d')) < strtotime($product->thoigianbatdau) || strtotime(date('Y-m-d')) > strtotime($product->thoigianketthuc)) ? $product->giatien : $product->giakhuyenmai,-3,',',',') }} VND</div>
                                <div class="col-2 text-secondary-d2">{{ number_format((strtotime(date('Y-m-d')) < strtotime($product->thoigianbatdau) || strtotime(date('Y-m-d')) > strtotime($product->thoigianketthuc)) ? $product->giatien * $product->soluong : $product->giakhuyenmai * $product->soluong, -3, ',', ',') }} VND</div>
                            </div>
                            @php
                                $count++;
                            @endphp
                        @endforeach        
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <div class="row mt-3">
                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-5 text-150 text-right text-danger">
                                    Thành tiền
                                </div>
                                <div class="col-7">
                                    <span class="text-150 text-success-d3 opacity-2">{{ number_format($order->thanhtien,-3,',',',') }} VND</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>