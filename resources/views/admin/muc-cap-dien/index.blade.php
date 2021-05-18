@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Mức cấp điện</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Mức cấp điện</li>
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i
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
                        <h6>Danh sách mức cấp điện</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Mã mức cấp điện</th>
                                <th>Tên mức cấp điện</th>
                                <th>Loại giá</th>
                                <th>Thời gian tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$item->ma_muc_cap_dien}}</td>
                                    <td>{{$item->ten_muc_cap_dien}}</td>
                                    <td>{{\App\MucCapDien::GIA[$item->loai_gia]}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('muc-cap-dien.edit',$item->ma_muc_cap_dien)}}"
                                           class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>

                                        <form id="delete-{{$item->ma_muc_cap_dien}}"
                                              action="{{route('muc-cap-dien.destroy',$item->ma_muc_cap_dien)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                               onclick="confirm('Bạn chọn xóa?') && $('#delete-{{$item->ma_muc_cap_dien}}').submit()"
                                               class="btn btn-default btn-sm">
                                                <i class="icon-fa icon-fa-trash"></i> Xóa</a>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade ls-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm mức cấp điện</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('muc-cap-dien.store')}}" method="POST">
                        <input name="ma_loai_dien" type="hidden" value="{{$ld}}">
                        <div class="modal-body">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="ten_muc_cap_dien">Tên mức cấp điện</label>
                                    <input type="text" class="form-control" id="ten_muc_cap_dien"
                                           placeholder="Tên mức cấp điện" name="ten_muc_cap_dien">
                                </div>

                                <div class="form-group">
                                    <label for="loai_gia">Loại giá</label>
                                    <select class="form-control" name="loai_gia" id="loai_gia">
                                        @foreach(\App\MucCapDien::GIA as $key=>$item)
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
