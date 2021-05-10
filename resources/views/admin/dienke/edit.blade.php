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
                <li class="breadcrumb-item"><a href="{{route('dienke.index')}}">Điện kế</a></li>
            </ol>
        </div>
        {{$dienke->so_cong_to}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('dienke.update',$dienke->ma_dien_ke)}}" method="POST">
                        @method('PUT')
                            <input type="hidden" name="role" value="{{$dienke->ma_dien_ke}}">
                            <div class="modal-body">
                            <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputCongTo">Số công tơ</label>
                                        <input type="number" class="form-control" id="inputCongTo" placeholder="Nhập công tơ" name="socongtu" value="{{$dienke->so_cong_to}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTuSo">Chỉ số cũ</label>
                                        <input type="number" class="form-control" id="inputTuSo" placeholder="Nhập số" name="chisocu" value="{{$dienke->chi_so_cu}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDenSo">Chỉ số mới</label>
                                        <input type="number" class="form-control" id="inputDenSo" placeholder="Nhập số" name="chisomoi" value="{{$dienke->chi_so_moi}}">
                                    </div>
                                     <div class="form-group">
                                        <label for="exampleInputLoaiDien">Khách hàng</label><br>
                                        <select class="form-control ls-select2 w-100" name="makhachhang">
                                            @foreach($users as $user)
                                                @if($dienke->ma_khach_hang ==  $user->id)
                                                    <option selected value="{{$user->id}}">{{$user->name}}</option>
                                                @else
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputLoaiDien">Loại điện</label><br>
                                        <select class="form-control ls-select2 w-100" name="maloaidien">
                                            @foreach($loaidien as $ld)
                                                @if($dienke->ma_loai_dien ==  $ld->ma_loai_dien)
                                                    <option selected value="{{$ld->ma_loai_dien}}">{{$ld->ten_loai_dien}}</option>
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
                                <a href="{{route('dienke.index')}}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button></a>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
