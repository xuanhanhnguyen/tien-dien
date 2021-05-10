@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Loại điện</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('loaidien.index')}}">Loại điện</a></li>
                <!-- <li class="breadcrumb-item active">Users</li> -->
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i class="icon-fa icon-fa-plus"></i>Thêm mới</a>
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Xóa </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tất cả người dùng</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Mã loại điện</th>
                                <th>Tên loại điện</th>
                                <th>Thời gian tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($loaidien as $ld)
                            <tr>
                                <td>{{$ld->ma_loai_dien}}</td>
                                <td>{{$ld->ten_loai_dien}}</td>
                                <td>{{$ld->created_at}}</td>
                                <td><a href="{{route('loaidien.edit',$ld->ma_loai_dien)}}" class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                    <a  data-toggle='modal' data-target='#confirm{{$ld->ma_loai_dien}}' class="btn btn-default btn-sm" > <i class="icon-fa icon-fa-trash"></i> Xóa</a></td>
                            </tr>
                            <div class='modal fade' id="confirm{{$ld->ma_loai_dien}}">
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'><strong>XÁC NHẬN XÓA</strong></h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Tất cả những thông tin liên quan tới loại điện này sẽ bị xóa hết</p>
                                            <p>Bạn có chắc chắn muốn xóa {{$ld->ten_loai_dien}}?</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Hủy</button>
                                            <a href='{{route('loaidien.delete',$ld->ma_loai_dien)}}'><button type='button' class='btn btn-primary'> Xóa </button></a>
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
                            <h5 class="modal-title" id="exampleModalLabel">Thêm mới loại điện</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('loaidien.store')}}" method="POST">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputUserName">Tên loại điện</label>
                                        <input type="text" class="form-control" id="inputUserName" placeholder="Tên loại điện" name="tenloaidien">
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
