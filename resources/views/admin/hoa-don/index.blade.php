@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Hóa đơn tiền điện</h3>
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
                        <h6>Hóa đơn tiền điện</h6>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered table-responsive-lg"
                               cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Mã hồ sơ</th>
                                <th>Mã khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Chỉ số cũ</th>
                                <th>Chỉ số mới</th>
                                <th>HS Nhân</th>
                                <th>ĐN Tiêu thụ</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($hd as $item)
                                <tr>
                                    <td>{{$item->ma_hoa_don}}</td>
                                    <td>{{$item->ho_so->ma_dksd_dien}}</td>
                                    <td>{{$item->ho_so->kh->id}}</td>
                                    <td>{{$item->ho_so->dia_chi}}</td>
                                    <td>{{$item->chi_so_cu}}</td>
                                    <td>{{$item->chi_so_moi}}</td>
                                    <td>{{$item->ho_so->hs_nhan}}</td>
                                    <td>{{($item->chi_so_moi - $item->chi_so_cu) * $item->ho_so->hs_nhan}}</td>
                                    <td>{{$item->tong_tien}}</td>
                                    <td>{{$item->trang_thai}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('hoa-don.show',$item->ma_hoa_don)}}"
                                           class="btn btn-default btn-sm" data-toggle="modal"
                                           data-target=".modal-detail">
                                            <i class="icon-fa icon-fa-plus"></i> Chi tiết</a>

                                        <div class="d-flex mt-1">
                                            <a href="{{route('hoa-don.edit',$item->ma_hoa_don)}}"
                                               class="btn btn-default btn-sm"><i
                                                        class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                            <form id="form-delete" class="ml-1"
                                                  action="{{route('hoa-don.destroy',$item->ma_hoa_don)}}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="#"
                                                   onclick="confirm('Bạn chọn xóa?') && $('#form-delete').submit()"
                                                   class="btn btn-default btn-sm">
                                                    <i class="icon-fa icon-fa-trash"></i> Xóa</a>
                                            </form>
                                        </div>
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

        @include('admin.hoa-don.modal-detail')

        <div class="modal fade ls-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm hóa đơn</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('hoa-don.store')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="ma_dksd_dien">Mã hồ sơ</label>
                                    <select class="form-control" name="ma_dksd_dien" id="ma_dksd_dien" required>
                                        <option value="">Chọn hồ sơ</option>
                                        @foreach($hs as $item)
                                            <option value="{{$item->ma_dksd_dien}}">{{$item->ma_dksd_dien}}
                                                - {{$item->kh->id}} - {{$item->kh->name}} __ {{$item->dia_chi}}</option>
                                        @endforeach
                                    </select>
                                    <small id="ma_dksd_dien" class="form-text text-muted">
                                        Mã hồ sơ - Mã khách hàng - Tên khách hàng __ Địa chỉ
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="">Chỉ số cũ</label>
                                    <input type="number" value="0"
                                           class="form-control" name="chi_so_cu" id="chi_so_cu"
                                           placeholder="Nhập chỉ số cũ" required>
                                </div>

                                <div class="form-group">
                                    <label for="">Chỉ số mới</label>
                                    <input type="number" value="0"
                                           class="form-control" name="chi_so_moi" id="chi_so_moi"
                                           placeholder="Nhập chỉ số mới" required>
                                </div>

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
@stop
