@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Đăng ký sử dụng điện</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Đăng ký sử dụng điện</li>
            </ol>
            <div class="page-actions">
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i
                            class="icon-fa icon-fa-plus"></i>Thêm mới</a>
                <button class="btn btn-danger"><i class="icon-fa icon-fa-trash"></i> Xóa</button>
            </div>
        </div>

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo</h4>
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Dách sách hồ sơ đăng ký sử dụng điện</h6>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Mã hồ sơ</th>
                                <th>Mã Khách hàng</th>
                                <th>Tài khoản</th>
                                <th>Tên khách hàng</th>
                                <th>Loại diện</th>
                                <th>Khu vực</th>
                                <th>HS Nhân</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($dksd as $item)
                                <tr>
                                    <td>{{$item->ma_dksd_dien}}</td>
                                    <td>{{$item->kh->id}}</td>
                                    <td>{{$item->kh->username}}</td>
                                    <td>{{$item->kh->name}}</td>
                                    <td>{{$item->loai_dien->ten_loai_dien}}</td>
                                    <td>{{$item->kv->ten_khu_vuc}} ({{$item->kv->don_vi}})</td>
                                    <td>{{$item->hs_nhan}}</td>
                                    <td>{{\App\DKSDDien::STATUS[$item->trang_thai]}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="d-flex"><a href="{{route('dksd-dien.edit',$item->ma_dksd_dien)}}"
                                                          class="btn btn-default btn-sm"><i
                                                    class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                        <form id="form-delete" class="ml-1"
                                              action="{{route('dksd-dien.destroy',$item->ma_dksd_dien)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <a href="#"
                                               onclick="confirm('Bạn chọn xóa?') && $('#form-delete').submit()"
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
                        <h5 class="modal-title" id="exampleModalLabel">Thêm khu vực</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('dksd-dien.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="ma_khach_hang">Khách hàng</label>
                                    <select class="form-control" name="ma_khach_hang" id="ma_khach_hang" required>
                                        <option value="">Chọn khách hàng</option>
                                        @foreach($kh as $item)
                                            <option value="{{$item->id}}">{{$item->id}} - {{$item->username}}
                                                - {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <small id="ma_khach_hang" class="form-text text-muted">
                                        Mã khách hàng - Tài khoản - Tên khách hàng
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="ma_loai_dien">Loại điện</label>
                                    <select class="form-control" name="ma_loai_dien" id="ma_loai_dien" required>
                                        <option value="">Chọn loại điện</option>
                                        @foreach($ld as $item)
                                            <option value="{{$item->ma_loai_dien}}">{{$item->ma_loai_dien}}
                                                - {{$item->ten_loai_dien}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="ma_khu_vuc">Khu vực</label>
                                    <select class="form-control" name="ma_khu_vuc" id="ma_khu_vuc" required>
                                        <option value="">Chọn khu vực</option>
                                        @foreach($kv as $item)
                                            <option value="{{$item->ma_khu_vuc}}">{{$item->ma_khu_vuc}}
                                                - {{$item->ten_khu_vuc}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Hệ số nhân</label>
                                    <input type="number" value="1"
                                           class="form-control" name="hs_nhan" id="hs_nhan"
                                           placeholder="Nhập hệ số nhân" required>
                                </div>

                                <div class="form-group">
                                    <label for="dia_chi">Địa chỉ</label>
                                    <input type="text"
                                           class="form-control" name="dia_chi" id="dia_chi"
                                           placeholder="Nhập địa chỉ" required>
                                </div>

                                <div class="form-group">
                                    <label for="trang_thai">Trạng thái</label>
                                    <select class="form-control" name="trang_thai" id="trang_thai" required>
                                        <option value="1">{{\App\DKSDDien::STATUS[1]}}</option>
                                        <option value="0">{{\App\DKSDDien::STATUS[0]}}</option>
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
@stop
