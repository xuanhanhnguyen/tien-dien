@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Thêm giá điện</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thêm giá điện</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('giadien.store')}}" method="POST">
                            <div class="modal-body">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="ma_muc_cap_dien">Mức cấp điện</label><br>
                                        <select class="form-control" id="ma_muc_cap_dien" name="ma_muc_cap_dien"
                                                onchange="location.href = '/admin/giadien/create?mcd='+$('#ma_muc_cap_dien').val()"
                                                required>
                                            @foreach($mcd as $item)
                                                <option @if($item->ma_muc_cap_dien == $id ) selected
                                                        @endif value="{{$item->ma_muc_cap_dien}}">{{$item->loaidien->ten_loai_dien}}
                                                    - {{$item->ten_muc_cap_dien}}</option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">
                                            Tên loại điện - Tên mức cấp điện
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="ten_gia_dien">Tên giá điện</label>
                                        <input type="text" class="form-control" id="ten_gia_dien"
                                               placeholder="Nhập tên giá điện"
                                               name="ten_gia_dien" required>
                                    </div>

                                    @if($_mcd->loai_gia == 1)
                                        <div class="form-group">
                                            <label for="tu_so">Từ số</label>
                                            <input type="number" value="0" class="form-control" id="tu_so"
                                                   placeholder="Nhập số"
                                                   name="tu_so" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="den_so">Đến số</label>
                                            <input type="number" value="0" class="form-control" id="den_so"
                                                   placeholder="Nhập số"
                                                   name="den_so" required>
                                        </div>
                                    @endif

                                    @if($_mcd->loai_gia == 3)
                                        <div class="form-group">
                                            <label for="tu_so">Từ kV</label>
                                            <input type="number" value="0" class="form-control" id="tu_so"
                                                   placeholder="Nhập kV"
                                                   name="tu_so" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="den_so">Đến kV</label>
                                            <input type="number" value="0" class="form-control" id="den_so"
                                                   placeholder="Nhập kV"
                                                   name="den_so" required>
                                        </div>
                                    @endif

                                    @if($_mcd->loai_gia == 2)
                                        <div class="form-group">
                                            <label for="binh_thuong">Giờ bình thường</label>
                                            <input type="number" class="form-control" id="binh_thuong"
                                                   placeholder="Nhập giá"
                                                   name="binh_thuong" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="thap_diem">Giờ thấp điểm</label>
                                            <input type="number" class="form-control" id="thap_diem"
                                                   placeholder="Nhập giá"
                                                   name="thap_diem" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cao_diem">Giờ cao điểm</label>
                                            <input type="number" class="form-control" id="cao_diem"
                                                   placeholder="Nhập giá"
                                                   name="cao_diem" required>
                                        </div>
                                    @endif

                                    @if($_mcd->loai_gia != 2)
                                        <div class="form-group">
                                            <label for="gia_dien">Giá Điện</label>
                                            <input type="number" class="form-control" id="gia_dien"
                                                   placeholder="Nhập giá tiền" name="gia_dien" required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @csrf
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
