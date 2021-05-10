@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">User Profile</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('giadien.index')}}">Loại điện</a></li>
                <!-- <li class="breadcrumb-item active">{{$giadien->ten_loai_dien}}</li> -->
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
                                        <label for="inputTuSo">Từ số</label>
                                        <input type="number" class="form-control" id="inputTuSo" placeholder="Nhập số" name="tuso" value="{{$giadien->tu_so}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDenSo">Đến số</label>
                                        <input type="number" class="form-control" id="inputDenSo" placeholder="Nhập số" name="denso" value="{{$giadien->den_so}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGiaTien">Giá Điện</label>
                                        <input type="number" class="form-control" id="inputGiaTien" placeholder="Nhập giá tiền" name="giadien" value="{{$giadien->gia_dien}}">
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputLoaiDien">Loại điện</label><br>
                                        <select class="form-control ls-select2 w-100" name="maloaidien">
                                            @foreach($loaidien as $ld)
                                                @if($giadien->ma_loai_dien ==  $ld->ma_loai_dien)
                                                <option value="{{$ld->ma_loai_dien}}" selected>{{$ld->ten_loai_dien}}</option>
                                                @else
                                                <option value="{{$ld->ma_loai_dien}}">{{$ld->ten_loai_dien}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @csrf
                            <div class="modal-footer">
                                <a href="{{route('loaidien.index')}}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button></a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
