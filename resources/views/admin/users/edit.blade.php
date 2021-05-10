@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Chỉnh sửa hồ sơ</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" onclick="window.history.back()">
                        <i class="icon-fa icon-fa-long-arrow-left"> Quay lại</i>
                    </a>
                </li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.update',$user->id)}}" method="POST">
                            @method('PUT')
                            <input type="hidden" name="role" value="{{$user->role}}">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputUserName">Tên đăng nhập</label>
                                        <input type="text" class="form-control" id="inputUserName"
                                               placeholder="Tên đăng nhập" value="{{$user->name}}" name="username">
                                    </div>
                                    <div class="form-group d-flex">
                                        <input type="checkbox" class="mr-3 mt-1 checkbox">
                                        <label>Change Password</label>
                                    </div>
                                    <div class="form-group password">
                                        <label for="exampleInputPassword">Mật khẩu</label>
                                        <input type="password" class="form-control" name="password"
                                               id="exampleInputPassword1=" placeholder="Password">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputFirstName">Họ</label>
                                            <input type="text" class="form-control" id="inputFirstName"
                                                   value="{{$user->firstname}}" name="firstname"
                                                   placeholder="Nhập họ">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputLastName">Tên</label>
                                            <input type="text" class="form-control" id="inputLastName"
                                                   value="{{$user->lastname}}" name="lastname"
                                                   placeholder="Nhập tên">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail">Email</label>
                                        <input type="text" class="form-control" id="exampleInputEmail" name="email"
                                               aria-describedby="emailHelp" value="{{$user->email}}"
                                               placeholder="Nhập email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPhone">Số điện thoại</label>
                                        <input type="text" class="form-control" id="exampleInputPhone" name="phone"
                                               aria-describedby="phoneHelp" value="{{$user->phone}}"
                                               placeholder="Nhập sô điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label>Giới tính</label>

                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                       @if($user->gender == 0) checked='checked' @endif type="radio"
                                                       name="gender" value="0"
                                                       id="checkMale">
                                                <label class="form-check-label" for="checkMale">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                       @if($user->gender == 1) checked='checked' @endif type="radio"
                                                       name="gender" value="1"
                                                       id="checkFemale">
                                                <label class="form-check-label" for="checkFemale">Nữ</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label>Ngày sinh</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control ls-datepicker"
                                                   value="{!! !empty($user->birthday) ?  $user->birthday->format('m/d/Y'): '' !!}"
                                                   name="birthday">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <!-- <div class="form-group">
                                        <label for="exampleInputRole">Quyền</label><br>
                                        <select class="form-control ls-select2" name="role">
                                            <option @if($user->role == 'Admin') checked='checked' @endif value="Admin">Admin</option>
                                            <option @if($user->role == 'Nhân Viên') checked='checked' @endif value="Nhân Viên">Nhân viên</option>
                                            <option @if($user->role == 'Khách hàng') checked='checked' @endif value="Khách hàng">Khách hàng</option>
                                        </select>
                                    </div> -->
                                </div>
                            </div>
                            @csrf
                            <div class="modal-footer">
                                <a href="{{route('users.index')}}">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                </a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop