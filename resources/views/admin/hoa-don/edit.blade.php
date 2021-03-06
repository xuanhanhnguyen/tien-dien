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
                                        <input type="text"
                                               value="{{$hd->ma_dksd_dien}} - {{$hd->ho_so->kh->id}} - {{$hd->ho_so->kh->name}} __ {{$hd->ho_so->dia_chi}}"
                                               class="form-control" disabled>
                                        <small id="ma_dksd_dien" class="form-text text-muted">
                                            Mã hồ sơ - Mã khách hàng - Tên khách hàng __ Địa chỉ
                                        </small>
                                    </div>

                                    @if($hd->ho_so->mcd->loai_gia == 2)
                                        <div class="form-group">
                                            <label for="tu_so[binh_thuong]">Từ số</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="number" value="{{$hd->chi_so_cu->binh_thuong}}"
                                                           class="form-control"
                                                           id="tu_so['binh_thuong']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_cu[binh_thuong]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ bình thường
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="{{$hd->chi_so_cu->thap_diem}}"
                                                           class="form-control"
                                                           id="tu_so['thap_diem']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_cu[thap_diem]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ thấp điểm
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="{{$hd->chi_so_cu->cao_diem}}"
                                                           class="form-control"
                                                           id="tu_so['cao_diem']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_cu[cao_diem]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ cao điểm
                                                    </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="den_so">Đến số</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="number" value="{{$hd->chi_so_moi->binh_thuong}}"
                                                           class="form-control"
                                                           id="den_so[binh_thuong]"
                                                           placeholder="Nhập số"
                                                           name="chi_so_moi[binh_thuong]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ bình thường
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="{{$hd->chi_so_moi->thap_diem}}"
                                                           class="form-control"
                                                           id="den_so['thap_diem']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_moi[thap_diem]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ thấp điểm
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="{{$hd->chi_so_moi->cao_diem}}"
                                                           class="form-control"
                                                           id="den_so['cao_diem']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_moi[cao_diem]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ cao điểm
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label for="tu_so">Từ số</label>
                                            <input type="number" value="{{$hd->chi_so_cu}}" class="form-control"
                                                   id="chi_so_cu"
                                                   placeholder="Nhập số"
                                                   name="chi_so_cu" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="den_so">Đến số</label>
                                            <input type="number" value="{{$hd->chi_so_moi}}" class="form-control"
                                                   id="chi_so_moi"
                                                   placeholder="Nhập số"
                                                   name="chi_so_moi" required>
                                        </div>
                                    @endif

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
                                            @if(Auth::user()->role == "Admin" || Auth::user()->role == "Nhân viên")
                                                <option @if($hd->trang_thai == 1) selected
                                                        @endif value="1">{{\App\HoaDon::STATUS[1]}}</option>
                                                <option @if($hd->trang_thai == 2) selected
                                                        @endif value="2">{{\App\HoaDon::STATUS[2]}}</option>
                                            @endif
                                            @if(Auth::user()->role == "Admin")
                                                <option @if($hd->trang_thai == 3) selected
                                                        @endif value="3">{{\App\HoaDon::STATUS[3]}}</option>
                                                <option @if($hd->trang_thai == 4) selected
                                                        @endif value="4">{{\App\HoaDon::STATUS[4]}}</option>
                                                <option @if($hd->trang_thai == 0) selected
                                                        @endif value="0">{{\App\HoaDon::STATUS[0]}}</option>
                                            @endif
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
