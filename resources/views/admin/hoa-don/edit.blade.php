@extends('admin.layouts.layout-basic')

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Chỉnh sửa hóa đơn</h3>
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
                        <form action="{{route('hoa-don.update',$hd->ma_hoa_don)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="">Mã hóa đơn</label>
                                        <input value="{{$hd->ma_hoa_don}}" disabled
                                               class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ma_dksd_dien">Mã hồ sơ</label>
                                        <select class="form-control" name="ma_dksd_dien" id="ma_dksd_dien" required>
                                            <option value="">Chọn hồ sơ</option>
                                            @foreach($hs as $item)
                                                <option @if($item->ma_dksd_dien == $hd->ma_dksd_dien) selected
                                                        @endif value="{{$item->ma_dksd_dien}}">{{$item->ma_dksd_dien}}
                                                    - {{$item->kh->id}}
                                                    - {{$item->kh->name}}
                                                    __ {{$item->dia_chi}}</option>
                                            @endforeach
                                        </select>
                                        <small id="ma_khach_hang" class="form-text text-muted">
                                            Mã hồ sơ - Mã khách hàng - Tên khách hàng __ Địa chỉ
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chỉ số cũ</label>
                                        <input type="number" value="{{$hd->chi_so_cu}}"
                                               class="form-control" name="chi_so_cu" id="chi_so_cu"
                                               placeholder="Nhập chỉ số cũ" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Chỉ số mới</label>
                                        <input type="number" value="{{$hd->chi_so_moi}}"
                                               class="form-control" name="chi_so_moi" id="chi_so_moi"
                                               placeholder="Nhập chỉ số mới" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tu_ngay">Từ ngày</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control ls-datepicker"
                                                   value="{{ $hd->tu_ngay }}"
                                                   name="tu_ngay" id="tu_ngay">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="den_ngay">Đến ngày</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control ls-datepicker"
                                                   value="{{$hd->den_ngay}}"
                                                   name="den_ngay" id="den_ngay">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                        <i class="icon-fa icon-fa-calendar"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="trang_thai">Trạng thái</label>
                                        <select class="form-control" name="trang_thai" id="trang_thai" required>
                                            <option @if($hd->trang_thai == 1) selected
                                                    @endif value="1">{{\App\HoaDon::STATUS[1]}}</option>
                                            <option @if($hd->trang_thai == 2) selected
                                                    @endif value="2">{{\App\HoaDon::STATUS[2]}}</option>
                                            <option @if($hd->trang_thai == 3) selected
                                                    @endif value="3">{{\App\HoaDon::STATUS[3]}}</option>
                                            <option @if($hd->trang_thai == 4) selected
                                                    @endif value="4">{{\App\HoaDon::STATUS[4]}}</option>
                                            <option @if($hd->trang_thai == 0) selected
                                                    @endif value="0">{{\App\HoaDon::STATUS[0]}}</option>
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
