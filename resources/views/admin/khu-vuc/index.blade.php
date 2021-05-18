@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Khu vực</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Khu vực</li>
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i
                            class="icon-fa icon-fa-plus"></i>Thêm mới</a>
            </div>
        </div>

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo</h4>
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tất cả khu vực</h6>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Mã khu vực</th>
                                <th>Tên khu vực</th>
                                <th>Đơn vị</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($khu_vuc as $item)
                                <tr>
                                    <td>{{$item->ma_khu_vuc}}</td>
                                    <td>{{$item->ten_khu_vuc}}</td>
                                    <td>{{$item->don_vi}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('khu-vuc.edit',$item->ma_khu_vuc)}}"
                                                          class="btn btn-default btn-sm"><i
                                                    class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                        <form id="delete-{{$item->ma_khu_vuc}}" class="ml-1"
                                              action="{{route('khu-vuc.destroy',$item->ma_khu_vuc)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                               onclick="confirm('Bạn chọn xóa?') && $('#delete-{{$item->ma_khu_vuc}}').submit()"
                                               class="btn btn-default btn-sm">
                                                <i class="icon-fa icon-fa-trash"></i> Xóa</a>
                                        </form>
                                    </td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Thêm khu vực</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('khu-vuc.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="ten_khu_vuc">Tên khu vực</label>
                                    <input type="text" class="form-control" id="ten_khu_vuc"
                                           placeholder="Nhập tên khu vực" name="ten_khu_vuc" required>
                                </div>
                                <div class="form-group">
                                    <label for="don_vi">Đơn vị</label>
                                    <textarea class="form-control" name="don_vi" id="don_vi" rows="3"
                                              placeholder="Nhập các đơn vị của khu vực" required></textarea>
                                    <small id="don_vi" class="form-text text-muted">Các đơn vị ngăn cách bởi dấu ", ".
                                        vd: Hưng Phúc, Hưng Bình
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
