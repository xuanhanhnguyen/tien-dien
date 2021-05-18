@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Giá điện</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('giadien.index')}}">Giá điện</a></li>
                <!-- <li class="breadcrumb-item active">Users</li> -->
            </ol>
            <div class="page-actions">
                <a href="{{route('giadien.create')}}" class="btn btn-primary"><i
                            class="icon-fa icon-fa-plus"></i>Thêm mới</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <form id="_loaidien" action="">
                    <div class="form-group d-flex align-items-center">
                        <label class="m-0" for="ld">Loại điện:</label>
                        <select onchange="$('#_loaidien').submit()" class="ml-1 form-control w-50" name="ld" id="ld">
                            @foreach($loaidien as $item)
                                <option @if($item->ma_loai_dien == $ld) selected
                                        @endif value="{{$item->ma_loai_dien}}">{{$item->ten_loai_dien}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Bảng giá điện</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2" class="text-center">Tên mức cấp điện</th>
                                <th colspan="3" class="text-center">Giá điện (đồng/kWh)</th>
                            </tr>
                            <tr>
                                <th class="text-center">Tên giá điện / Khung giờ</th>
                                <th class="text-center">Giá</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                            </thead>

                            @foreach($data as $item)
                                <tr>
                                    <td rowspan="{{$item->loai_gia == 2 ? 4: (sizeof($item->giadien)+1)}}">{{$item->ten_muc_cap_dien}}</td>
                                </tr>
                                @foreach($item->giadien as $key => $giadien)
                                    @if($item->loai_gia == 2)
                                        <tr>
                                            <td>Giờ bình thường</td>
                                            <td>
                                                {{_price($giadien->binh_thuong)}}
                                            </td>
                                            <td rowspan="3">
                                                chỉnh sửa/xóa
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giờ thấp điểm</td>
                                            <td>
                                                {{_price($giadien->thap_diem)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giờ cao điêm</td>
                                            <td>
                                                {{_price($giadien->cao_diem)}}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$giadien->ten_gia_dien}}</td>
                                            <td>
                                                {{_price($giadien->gia_dien)}}
                                            </td>
                                            <td>
                                                <a href="{{route('giadien.edit',$giadien->ma_gia_dien)}}"
                                                   class="btn btn-default btn-sm"><i
                                                            class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                                <form id="delete-{{$giadien->ma_gia_dien}}"
                                                      action="{{route('giadien.destroy',$giadien->ma_gia_dien)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#"
                                                       onclick="confirm('Bạn chọn xóa?') && $('#delete-{{$giadien->ma_gia_dien}}').submit()"
                                                       class="btn btn-default btn-sm">
                                                        <i class="icon-fa icon-fa-trash"></i> Xóa</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
