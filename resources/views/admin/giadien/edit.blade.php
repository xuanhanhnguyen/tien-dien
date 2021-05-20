@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Chỉnh sửa giá điện</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa giá điện</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('giadien.update',$giadien->ma_gia_dien)}}" method="POST">
                            @method('PUT')
                            <input type="hidden" name="role" value="{{$giadien->ma_gia_dien}}">
                            <div class="modal-body">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="ma_muc_cap_dien">Mức cấp điện</label><br>
                                        <select class="form-control" id="ma_muc_cap_dien" name="ma_muc_cap_dien"
                                                onchange="location.href = 'edit?mcd='+$('#ma_muc_cap_dien').val()"
                                                required>
                                            @foreach($mcd as $item)
                                                <option @if($item->ma_muc_cap_dien == $id || $item->ma_muc_cap_dien == $giadien->ma_muc_cap_dien) selected
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
                                               placeholder="Nhập tên giá điện" value="{{$giadien->ten_gia_dien}}"
                                               name="ten_gia_dien" required>
                                    </div>

                                    @if($_mcd->loai_gia == 1)
                                        <div class="form-group">
                                            <label for="tu_so">Từ số</label>
                                            <input type="number" class="form-control" id="tu_so"
                                                   placeholder="Nhập số" value="{{$giadien->tu_so}}"
                                                   name="tu_so" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="den_so">Đến số</label>
                                            <input type="number" value="{{$giadien->den_so}}" class="form-control"
                                                   id="den_so"
                                                   placeholder="Nhập số"
                                                   name="den_so" required>
                                        </div>
                                    @endif

                                    @if($_mcd->loai_gia == 3)
                                        <div class="form-group">
                                            <label for="tu_so">Từ kV</label>
                                            <input type="number" value="{{$giadien->tu_so}}" class="form-control"
                                                   id="tu_so"
                                                   placeholder="Nhập kV"
                                                   name="tu_so" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="den_so">Đến kV</label>
                                            <input type="number" value="{{$giadien->den_so}}" class="form-control"
                                                   id="den_so"
                                                   placeholder="Nhập kV"
                                                   name="den_so" required>
                                        </div>
                                    @endif

                                    @if($_mcd->loai_gia == 2)
                                        <div class="form-group">
                                            <label for="binh_thuong">Giờ bình thường</label>
                                            <input type="number" class="form-control" id="binh_thuong"
                                                   placeholder="Nhập giá" value="{{$giadien->binh_thuong}}"
                                                   name="binh_thuong" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="thap_diem">Giờ thấp điểm</label>
                                            <input type="number" class="form-control" id="thap_diem"
                                                   placeholder="Nhập giá" value="{{$giadien->thap_diem}}"
                                                   name="thap_diem" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cao_diem">Giờ cao điểm</label>
                                            <input type="number" class="form-control" id="cao_diem"
                                                   placeholder="Nhập giá" value="{{$giadien->cao_diem}}"
                                                   name="cao_diem" required>
                                        </div>
                                    @endif

                                    @if($_mcd->loai_gia != 2)
                                        <div class="form-group">
                                            <label for="gia_dien">Giá Điện</label>
                                            <input type="number" class="form-control" id="gia_dien"
                                                   value="{{$giadien->gia_dien}}"
                                                   placeholder="Nhập giá tiền" name="gia_dien" required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @csrf
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
