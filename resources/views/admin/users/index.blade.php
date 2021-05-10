@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Tất cả tài khoản</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Tất cả tài khoản</li>
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i
                            class="icon-fa icon-fa-plus"></i>Thêm mới</a>
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Xóa</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tất cả tài khoản</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Thời gian tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td><a href="{{route('users.edit',$user->id)}}" class="btn btn-default btn-sm"><i
                                                    class="icon-fa icon-fa-search"></i> Hiển thị</a>
                                        <a href="{{route('users.destroy',$user->id)}}" class="btn btn-default btn-sm"
                                           data-token="{{csrf_token()}}" data-delete data-confirmation="notie"> <i
                                                    class="icon-fa icon-fa-trash"></i> Xóa</a></td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade ls-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mới người dùng</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="user/add-new" method="POST">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputUserName">Tên đăng nhập</label>
                                    <input type="text" class="form-control" id="inputUserName"
                                           placeholder="Tên đăng nhập" name="username">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputRole">Quyền</label><br>
                                    <select class="form-control ls-select2" name="role">
                                        <option value="Admin">Admin</option>
                                        <option value="Nhân viên">Nhân viên</option>
                                        <option value="Khách hàng">Khách hàng</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password"
                                           id="exampleInputPassword1=" placeholder="Password">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputFirstName">Họ</label>
                                        <input type="text" class="form-control" id="inputFirstName" name="firstname"
                                               placeholder="Nhập họ">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputLastName">Tên</label>
                                        <input type="password" class="form-control" id="inputLastName" name="lastname"
                                               placeholder="Nhập tên">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail" name="email"
                                           aria-describedby="emailHelp" placeholder="Nhập email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhone">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleInputPhone" name="phone"
                                           aria-describedby="phoneHelp" placeholder="Nhập sô điện thoại">
                                </div>
                                <div class="form-group">
                                    <label>Giới tính</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="0"
                                                   id="checkMale">
                                            <label class="form-check-label" for="checkMale">Nam</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" value="1"
                                                   id="checkFemale">
                                            <label class="form-check-label" for="checkFemale">Nữ</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Ngày sinh</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control ls-datepicker" value="" name="birthday">
                                        <div class="input-group-append">
                                                <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
