@extends('admin.layouts.layout-basic')

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Thêm hóa đơn tiền điện</h3>
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
                        <form action="{{route('hoa-don.store')}}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="ma_dksd_dien">Mã hồ sơ</label>
                                        <select onchange="location.href = '/admin/hoa-don/create?id='+$('#ma_dksd_dien').val()"
                                                class="form-control" name="ma_dksd_dien" id="ma_dksd_dien" required>
                                            <option value="">Chọn hồ sơ</option>
                                            @foreach($dksd as $item)
                                                <option @if($hs->ma_dksd_dien == $item->ma_dksd_dien) selected
                                                        @endif value="{{$item->ma_dksd_dien}}">{{$item->ma_dksd_dien}}
                                                    - {{$item->kh->id}} - {{$item->kh->name}}
                                                    __ {{$item->dia_chi}}</option>
                                            @endforeach
                                        </select>
                                        <small id="ma_dksd_dien" class="form-text text-muted">
                                            Mã hồ sơ - Mã khách hàng - Tên khách hàng __ Địa chỉ
                                        </small>
                                    </div>

                                    @if(isset($hs->mcd) && $hs->mcd->loai_gia == 2)
                                        <div class="form-group">
                                            <label for="tu_so['binh_thuong']">Từ số</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="number" value="0" class="form-control"
                                                           id="tu_so['binh_thuong']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_cu[binh_thuong]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ bình thường
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="0" class="form-control"
                                                           id="tu_so['thap_diem']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_cu[thap_diem]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ thấp điểm
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="0" class="form-control"
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
                                                    <input type="number" value="0" class="form-control"
                                                           id="den_so[binh_thuong]"
                                                           placeholder="Nhập số"
                                                           name="chi_so_moi[binh_thuong]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ bình thường
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="0" class="form-control"
                                                           id="den_so['thap_diem']"
                                                           placeholder="Nhập số"
                                                           name="chi_so_moi[thap_diem]" required>
                                                    <small class="form-text text-muted">
                                                        Chỉ số giờ thấp điểm
                                                    </small>
                                                </div>

                                                <div class="col-md-4">
                                                    <input type="number" value="0" class="form-control"
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
                                            <label for="chi_so_cu">Từ số</label>
                                            <input type="number" value="0" class="form-control" id="chi_so_cu"
                                                   placeholder="Nhập số"
                                                   name="chi_so_cu" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="chi_so_moi">Đến số</label>
                                            <input type="number" value="0" class="form-control" id="chi_so_moi"
                                                   placeholder="Nhập số"
                                                   name="chi_so_moi" required>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="tu_ngay">Từ ngày</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control ls-datepicker"
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
                                            <option value="1">{{\App\HoaDon::STATUS[1]}}</option>
                                            <option value="2">{{\App\HoaDon::STATUS[2]}}</option>
                                            <option value="3">{{\App\HoaDon::STATUS[3]}}</option>
                                            <option value="4">{{\App\HoaDon::STATUS[4]}}</option>
                                            <option value="0">{{\App\HoaDon::STATUS[0]}}</option>
                                        </select>
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
    </div>
@stop
