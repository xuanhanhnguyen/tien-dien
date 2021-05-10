@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
    <style>
        .select2{
            width:100% !important
        }
    </style>
@stop

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Hóa đơn</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{route('users.index')}}">{{$user->name}}</a></li>
                <li class="breadcrumb-item"><a >Hóa đơn</a></li>
                <!-- <li class="breadcrumb-item active">Users</li> -->
            </ol>
            <div class="page-actions">
                <!-- <a href="#" class="btn btn-primary" data-toggle="modal" data-target=".ls-example-modal-lg"><i class="icon-fa icon-fa-plus"></i>Thêm mới</a> -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Tất cả hóa đơn</h6>

                        <div class="card-actions">

                        </div>
                    </div>
                    <div class="card-body">
                        <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Chỉ số cũ</th>
                                <th>Chỉ số mới</th>
                                <th>Tổng điện kế</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thời gian tạo</th>
                                <th>Chức năng</th>
                            </tr>
                            </thead>
                            @foreach($hoadon as $dk)
                            <tr>
                                <td>{{!empty($dk->hoadon) ? $dk->hoadon->ma_hoa_don : ''}}</td>
                                <td>{{$dk->chi_so_cu}}</td>
                                <td>{{$dk->chi_so_moi}}</td>
                                <td>{{!empty($dk->hoadon) ? $dk->hoadon->tong_dien_ke : ''}}</td>
                                <td>{{!empty($dk->hoadon) ? $dk->hoadon->tong_tien : ''}}</td>
                                <td>{{!empty($dk->hoadon) ? ($dk->hoadon->trang_thai ? 'Đã thanh toán' : 'Chưa thanh toán') : ''}}</td>
                                <td>{{$dk->created_at}}</td>
                                <td><a data-toggle='modal' data-target='#detail{{$dk->ma_dien_ke}}' class="btn btn-default btn-sm"><i class="icon-fa icon-fa-edit"></i> Chi tiết</a>
                                @if(!empty($dk->hoadon) && !$dk->hoadon->trang_thai)
                                    <a  data-toggle='modal' data-target='#confirm{{$dk->ma_dien_ke}}' class="btn btn-default btn-sm" > <i class="icon-fa icon-fa-check"></i> Thanh toán</a>
                                @endif
                                </td>
                            </tr>
                            <div class='modal fade' id="confirm{{$dk->ma_dien_ke}}">
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title'><strong>XÁC NHẬN THANH TOÁN</strong></h5>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                            </button>
                                        </div>
                                        <div class='modal-body'>
                                            <p>Bạn có chắc chắn muốn xác nhận thanh toán cho hóa đơn này?</p>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Hủy</button>
                                            <a href='{{route('hoadon.xacnhan',$dk->ma_dien_ke)}}'><button type='button' class='btn btn-primary'> Thanh toán </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@foreach($hoadon as $dk)

<div class='modal fade' id="detail{{$dk->ma_dien_ke}}">
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'><strong>Chi tiết hóa đơn</strong></h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <table id="users-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Số điện</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    @if(!empty($dk->hoadon) && !empty($dk->hoadon->chitiethd))
                        @foreach($dk->hoadon->chitiethd as $key=>$ct)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$ct->so_dien}}</td>
                            <td>{{$ct->don_gia}}</td>
                            <td>{{$ct->tien}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>Tổng</td>
                            <td>{{!empty($dk->hoadon) ? $dk->hoadon->tong_dien_ke : ''}}</td>
                            <td></td>
                            <td>{{!empty($dk->hoadon) ? $dk->hoadon->tong_tien : ''}}</td>
                        </tr>
                    @endif
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Đóng</button>
            </div>
        </div>
    </div>
</div>

@endforeach
@stop
