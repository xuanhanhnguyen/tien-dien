@extends('admin.layouts.layout-basic')

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
                        <form action="{{route('dksd-dien.update',$dksd->ma_dksd_dien)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="ma_khach_hang">Khách hàng</label>
                                        <select class="form-control" name="ma_khach_hang" id="ma_khach_hang" required>
                                            <option value="">Chọn khách hàng</option>
                                            @foreach($kh as $item)
                                                <option @if($dksd->ma_khach_hang === $item->id) selected
                                                        @endif value="{{$item->id}}">{{$item->username}}
                                                    - {{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <small id="ma_khach_hang" class="form-text text-muted">
                                            Mã khách hàng - Tài khoản - Tên khách hàng
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="ma_muc_cap_dien">Loại điện/Mức cấp điện</label>
                                        <select class="form-control" name="ma_muc_cap_dien" id="ma_muc_cap_dien"
                                                required>
                                            <option value="">Chọn</option>
                                            @foreach($mcd as $item)
                                                <option @if($dksd->ma_muc_cap_dien === $item->ma_muc_cap_dien) selected
                                                        @endif value="{{$item->ma_muc_cap_dien}}">{{$item->loaidien->ten_loai_dien}}
                                                    - {{$item->ten_muc_cap_dien}}</option>
                                            @endforeach
                                        </select>

                                        <small id="ma_muc_cap_dien" class="form-text text-muted">
                                            Tên loại điện - Tên mức cấp điện
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="dien_ap">Điện áp</label>
                                        <input id="dien_ap" type="text" class="form-control" value="{{$dksd->dien_ap}}"
                                               required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ma_khu_vuc">Khu vực</label>
                                        <select class="form-control" name="ma_khu_vuc" id="ma_khu_vuc" required>
                                            <option value="">Chọn khu vực</option>
                                            @foreach($kv as $item)
                                                <option @if($dksd->ma_khu_vuc === $item->ma_khu_vuc) selected
                                                        @endif value="{{$item->ma_khu_vuc}}">{{$item->ma_khu_vuc}}
                                                    - {{$item->ten_khu_vuc}}</option>
                                            @endforeach
                                        </select>

                                        <small id="ma_muc_cap_dien" class="form-text text-muted">
                                            Mã khu vực - Tên khu vực
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Hệ số nhân</label>
                                        <input type="number" value="{{$dksd->hs_nhan}}"
                                               class="form-control" name="hs_nhan" id="hs_nhan"
                                               placeholder="Nhập hệ số nhân" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="dia_chi">Địa chỉ</label>
                                        <input type="text" value="{{$dksd->dia_chi}}"
                                               class="form-control" name="dia_chi" id="dia_chi"
                                               placeholder="Nhập địa chỉ" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="trang_thai">Trạng thái</label>
                                        <select class="form-control" name="trang_thai" id="trang_thai" required>
                                            <option @if($dksd->trang_thai == 1) selected
                                                    @endif value="1">{{\App\DKSDDien::STATUS[1]}}</option>
                                            <option @if($dksd->trang_thai == 0) selected
                                                    @endif value="0">{{\App\DKSDDien::STATUS[0]}}</option>
                                        </select>
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
