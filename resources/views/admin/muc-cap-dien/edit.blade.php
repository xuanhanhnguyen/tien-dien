@extends('admin.layouts.layout-basic')

@section('content')
    <div class="main-content page-profile">
        <div class="page-header">
            <h3 class="page-title">Chỉnh sửa múc cấp điện</h3>
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
                        <form action="{{route('muc-cap-dien.update',$data->ma_muc_cap_dien)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="ten_muc_cap_dien">Tên mức cấp điện</label>
                                        <input type="text" class="form-control" id="ten_muc_cap_dien"
                                               value="{{$data->ten_muc_cap_dien}}"
                                               placeholder="Tên mức cấp điện" name="ten_muc_cap_dien">
                                    </div>

                                    <div class="form-group">
                                        <label class="m-0" for="ma_loai_dien">Loại điện</label>
                                        <select class="form-control"
                                                name="ma_loai_dien" id="ma_loai_dien">
                                            @foreach($loaidien as $item)
                                                <option @if($item->ma_loai_dien == $data->ma_loai_dien) selected
                                                        @endif value="{{$item->ma_loai_dien}}">{{$item->ten_loai_dien}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="loai_gia">Loại giá</label>
                                        <select class="form-control" name="loai_gia" id="loai_gia" required>
                                            @foreach(\App\MucCapDien::GIA as $key=>$item)
                                                <option @if($key == $data->loai_gia) selected
                                                        @endif value="{{$key}}">{{$item}}</option>
                                            @endforeach
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
