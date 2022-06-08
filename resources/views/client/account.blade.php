@extends('client.layout.master')
@section('content')
    <!-- nội dung của trang  -->
    <section class="account-page my-3">
        <div class="container">
            <div class="page-content bg-white">
                <div class="account-page-tab-content m-4">
                    <!-- 2 tab: thông tin tài khoản, danh sách đơn hàng  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-taikhoan-tab" data-toggle="tab" href="#nav-taikhoan"
                                role="tab" aria-controls="nav-home" aria-selected="true">Thông tin tài khoản</a>
                            <a class="nav-item nav-link" id="nav-donhang-tab" data-toggle="tab" href="#nav-donhang"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Danh sách đơn hàng</a>
                        </div>
                    </nav>

                    <!-- nội dung 2 tab -->
                    <div class="tab-content">

                        <!-- nội dung tab 1: thông tin tài khoản  -->
                        <div class="tab-pane fade show active pl-4 " id="nav-taikhoan" role="tabpanel"
                            aria-labelledby="nav-taikhoan-tab">
                            <div class="offset-md-4 mt-3">
                                <h3 class="account-header">Thông tin tài khoản</h3>
                            </div>
                            <form action="" method="POST">

                                @csrf

                                <div class="hoten my-3">
                                    <div class="row">
                                        <label class="col-md-2 offset-md-2" for="name">Họ tên</label>
                                        <input class="col-md-4" type="text" name="name" value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="email my-3">
                                    <div class="row">
                                        <label class="col-md-2 offset-md-2" for="email">Địa chỉ email</label>
                                        <input class="col-md-4" type="email" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="hoten my-3">
                                    <div class="row">
                                        <label class="col-md-2 offset-md-2" for="phone">Số điện thoại</label>
                                        <input class="col-md-4" type="tel" name="phone" value="{{ $user->phone }}" pattern="[0-9]{10}" required>
                                    </div>
                                </div>
                                <div class="checkbox-change-pass my-3">
                                    <div class="row">
                                        <input type="checkbox" name="changepass" id="changepass" class="offset-md-4"
                                            style="margin-top: 6px;margin-right: 5px; ">
                                        <label for="changepass">Thay đổi mật khẩu</label>
                                    </div>
                                </div>
                                <div class="thay-doi-mk">
                                    <div class="mkcu my-3">
                                        <div class="row">
                                            <label class="col-md-2 offset-md-2" for="oldpass">Mật khẩu cũ</label>
                                            <input class="col-md-4" type="password" name="oldpass" id="oldpass">
                                        </div>
                                    </div>
                                    <div class="mkmoi my-3">
                                        <div class="row">
                                            <label class="col-md-2 offset-md-2" for="newpass">Mật khẩu mới</label>
                                            <input class="col-md-4" type="password" name="newpass" id="newpass">
                                        </div>
                                    </div>
                                    <div class="xacnhan-mkmoi my-3">
                                        <div class="row">
                                            <label class="col-md-2 offset-md-2" for="confirmpass">Xác nhận mật
                                                khẩu</label>
                                            <input class="col-md-4" type="password" name="confirmpass" id="confirmpass">
                                        </div>
                                    </div>
                                    <div class="capnhat my-3">
                                        <div class="row">
                                            <button type="submit"
                                                class="button-capnhat text-uppercase offset-md-4 btn btn-warning mb-4">Cập
                                                nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- nội dung tab 2: danh sách đơn hàng -->
                        <div class="tab-pane fade py-3" id="nav-donhang" role="tabpanel" aria-labelledby="nav-donhang-tab">
                            <div class="donhang-table">
                                <table class="m-auto">
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày mua</th>
                                        <th>Sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $('#oldpass').prop('disabled',true);
        $('#newpass').prop('disabled',true);
        $('#confirmpass').prop('disabled',true);
        $('#oldpass').prop('required',false);
        $('#newpass').prop('required',false);
        $('#confirmpass').prop('required',false);
        $('#changepass').change(function () {
            if (this.checked) {
                $('#oldpass').prop('disabled',false);
                $('#newpass').prop('disabled',false);
                $('#confirmpass').prop('disabled',false);
                $('#oldpass').prop('required',true);
                $('#newpass').prop('required',true);
                $('#confirmpass').prop('required',true);
            } else {
                $('#oldpass').prop('disabled',true);
                $('#newpass').prop('disabled',true);
                $('#confirmpass').prop('disabled',true);
                $('#oldpass').prop('required',false);
                $('#newpass').prop('required',false);
                $('#confirmpass').prop('required',false);
            }
        });
    </script>
@endsection
