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
                <li class="breadcrumb-item"><a href="{{route('loaidien.index')}}">Loại điện</a></li>
                <li class="breadcrumb-item active">{{$loaidien->ten_loai_dien}}</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <form action="{{route('loaidien.update',$loaidien->ma_loai_dien)}}" method="POST">
                    @method('PUT')
                    <input type="hidden" name="role" value="{{$loaidien->ma_loai_dien}}">
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputUserName">Tên loại điện</label>
                                        <input type="text" class="form-control" id="inputUserName" placeholder="Tên loại điện" value="{{$loaidien->ten_loai_dien}}" name="tenloaidien">
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
