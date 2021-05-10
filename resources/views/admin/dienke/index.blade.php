@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
    <style>
        .select2{
            width:100% !important
        }
    </style>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Lượng điện tiêu thụ</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('dienke.index')}}">Lượng điện tiêu thụ</a></li>
                <!-- <li class="breadcrumb-item active">Users</li> -->
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i class="icon-fa icon-fa-plus"></i>Thêm mới</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tất cả điện kế</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Mã điện kế</th>
                                <th>Tên khách hàng</th>
                                <th>Chỉ số cũ</th>
                                <th>Chỉ số mới</th>
                                <th>Loại điện</th>
                                <th>Thời gian tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($dienke as $dk)
                            <tr>
                                <td>{{$dk->ma_dien_ke}}</td>
                                <td>{{!empty($dk->khachhang) ? $dk->khachhang->firstname.' '.$dk->khachhang->lastname : ''}}</td>
                                <td>{{$dk->chi_so_cu}}</td>
                                <td>{{$dk->chi_so_moi}}</td>
                                <td>{{!empty($dk->loaidien) ? $dk->loaidien->ten_loai_dien : ''}}</td>
                                <td>{{$dk->created_at}}</td>
                                <td><a href="{{route('dienke.edit',$dk->ma_dien_ke)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                    <a  data-toggle='modal' data-target='#confirm{{$dk->ma_dien_ke}}' class="btn btn-default btn-sm" > <i class="icon-fa icon-fa-trash"></i> Xóa</a></td>
                            </tr>
                            <div class='modal fade' id="confirm{{$dk->ma_dien_ke}}">
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'><strong>XÁC NHẬN XÓA</strong></h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Tất cả những thông tin liên quan tới điện kế này sẽ bị xóa hết</p>
                                            <p>Bạn có chắc chắn muốn xóa điện kế này?</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Hủy</button>
                                            <a href='{{route('dienke.delete',$dk->ma_dien_ke)}}'><button type='button' class='btn btn-primary'> Xóa </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade ls-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Thêm mới điện kế</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('dienke.store')}}" method="POST">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputCongTo">Số công tơ</label>
                                        <input type="number" class="form-control" id="inputCongTo" placeholder="Nhập công tơ" name="socongtu">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTuSo">Chỉ số cũ</label>
                                        <input type="number" class="form-control" id="inputTuSo" placeholder="Nhập số" name="chisocu">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDenSo">Chỉ số mới</label>
                                        <input type="number" class="form-control" id="inputDenSo" placeholder="Nhập số" name="chisomoi">
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputLoaiDien">Khách hàng</label><br>
                                        <select class="form-control ls-select2 w-100" name="makhachhang">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputLoaiDien">Loại điện</label><br>
                                        <select class="form-control ls-select2 w-100" name="maloaidien">
                                            @foreach($loaidien as $ld)
                                            <option value="{{$ld->ma_loai_dien}}">{{$ld->ten_loai_dien}}</option>
                                            @endforeach
                                        </select>
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
