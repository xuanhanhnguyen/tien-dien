@extends('admin.layouts.layout-basic')

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Chỉnh sửa khu vực</h3>
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
                        <form action="{{route('khu-vuc.update',$khu_vuc->ma_khu_vuc)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="ten_khu_vuc">Tên khu vực</label>
                                        <input type="text" class="form-control" id="ten_khu_vuc"
                                               value="{{$khu_vuc->ten_khu_vuc}}"
                                               placeholder="Nhập tên khu vực" name="ten_khu_vuc" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="don_vi">Đơn vị</label>
                                        <textarea class="form-control" name="don_vi" id="don_vi" rows="3"
                                                  placeholder="Nhập các đơn vị của khu vực"
                                                  required>{{$khu_vuc->don_vi}}</textarea>
                                        <small id="don_vi" class="form-text text-muted">
                                            Các đơn vị ngăn cách bởi dấu ", ". vd: Hưng Phúc, Hưng Bình
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="{{route('khu-vuc.index')}}">
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
