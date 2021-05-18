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
            @if(Auth::user()->role === "Admin")
                <div class="page-actions">
                    <a href="/admin/hoa-don/create" class="btn btn-primary">
                        <i class="icon-fa icon-fa-plus"></i>Thêm mới</a>
                </div>
            @endif
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
                                <th>Tên khách hàng</th>
                                <th>Địa chỉ</th>
                                <th>Chỉ số cũ</th>
                                <th>Chỉ số mới</th>
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
                                    <td>{{$item->ho_so->kh->name}}</td>
                                    <td>{{$item->ho_so->dia_chi}}</td>
                                    <td>
                                        @if($item->ho_so->mcd->loai_gia == 2)
                                            @php
                                                $_chi_so_cu = json_decode($item->chi_so_cu)
                                            @endphp
                                            <p>BT: {{$_chi_so_cu->binh_thuong}}</p>
                                            <p>CD: {{$_chi_so_cu->cao_diem}}</p>
                                            <p>TD: {{$_chi_so_cu->thap_diem}}</p>
                                        @else
                                            {{$item->chi_so_cu}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->ho_so->mcd->loai_gia == 2)
                                            @php
                                                $_chi_so_moi = json_decode($item->chi_so_moi)
                                            @endphp
                                            <p>BT: {{$_chi_so_moi->binh_thuong}}</p>
                                            <p>CD: {{$_chi_so_moi->cao_diem}}</p>
                                            <p>TD: {{$_chi_so_moi->thap_diem}}</p>
                                        @else
                                            {{$item->chi_so_moi}}
                                        @endif
                                    </td>
                                    <td>{{\App\HoaDon::STATUS[$item->trang_thai]}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('hoa-don.show',$item->ma_hoa_don)}}"
                                           class="btn btn-default btn-sm" data-toggle="modal"
                                           data-target=".modal-detail-{{$item->ma_hoa_don}}">
                                            <i class="icon-fa icon-fa-plus"></i> Hóa đơn</a>
                                        <a href="{{route('hoa-don.edit',$item->ma_hoa_don)}}"
                                           class="btn btn-default btn-sm"><i
                                                    class="icon-fa icon-fa-edit"></i> Chỉnh sửa</a>
                                        @if(Auth::user()->role === "Admin")
                                            <form id="form-delete"
                                                  action="{{route('hoa-don.destroy',$item->ma_hoa_don)}}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="#"
                                                   onclick="confirm('Bạn chọn xóa?') && $('#form-delete').submit()"
                                                   class="btn btn-default btn-sm">
                                                    <i class="icon-fa icon-fa-trash"></i> Xóa</a>
                                            </form>
                                        @endif
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

        @foreach($hd as $item)
            <div class="modal fade modal-detail modal-detail-{{$item->ma_hoa_don}}" tabindex="-1" role="dialog"
                 aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div class="card-body hd-detail">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="hd-header text-center">
                                    <h5 class="text-primary">HÓA ĐƠN GTGT (TIỀN ĐIỆN)</h5>
                                    <p class="text-primary">Từ ngày 22/04/2021 Đến ngày 21/05/2021</p>
                                </div>
                                <div class="hd-main">
                                    <div class="info">
                                        <p class="font-weight-bold">Điện lực Thành Phố Vinh</p>
                                        <p><span class="text-primary">Địa chỉ: </span>
                                            <span class="font-weight-bold">Số 10 - Đường Lê Duẩn - Phường Trung đô - TP.Vinh - Nghệ An</span>
                                        </p>
                                        <div class="row mb-2">
                                            <div class="col-4">
                                                <p><span class="text-primary">SĐT: </span> <span
                                                            class="font-weight-bold">0383.939.393</span>
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p><span class="text-primary">MST: </span> <span
                                                            class="font-weight-bold">1010010041717 - 017</span>
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <p><span class="text-primary">ĐT Sửa chữa: </span> <span
                                                            class="font-weight-bold text-danger">190067696</span></p>
                                            </div>
                                        </div>
                                        <p><span class="text-primary font-weight-bold">Tên khách hàng: </span> <span
                                                    class="font-weight-bold">{{$item->ho_so->kh->name}}</span></p>
                                        <p><span class="text-primary">Địa chỉ: </span> <span
                                                    class="font-weight-bold">{{$item->ho_so->kh->address}}</span>
                                        </p>
                                        <div class="row">
                                            <div class="col-4">
                                                <p><span class="text-primary">SĐT: </span> <span
                                                            class="font-weight-bold">{{$item->ho_so->kh->phone}}</span>
                                            </div>
                                            <div class="col-4">
                                                <p><span class="text-primary">MST: </span> <span
                                                            class="font-weight-bold">1010010041717 - 017</span>
                                            </div>
                                            <div class="col-2">
                                                <p>
                                                    <span class="text-primary">Số công tơ: </span>{{$item->ho_so->ma_dksd_dien}}
                                                </p>
                                            </div>
                                            <div class="col-2">
                                                <p><span class="text-primary">Số hộ: </span> 1</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <p><span class="text-primary">Mã KH: </span> <span
                                                            class="font-weight-bold text-danger">{{$item->ho_so->ma_khach_hang}}</span>
                                            </div>
                                            <div class="col-4">
                                                <p><span class="text-primary">Mã HD: </span> <span
                                                            class="font-weight-bold text-danger">{{$item->ma_hoa_don}}</span>
                                            </div>
                                            <div class="col-2">
                                                <p>
                                                    <span class="text-primary">Mã KV: </span>{{$item->ho_so->kv->ma_khu_vuc}}
                                                </p>
                                            </div>
                                            <div class="col-2">
                                                <p><span class="text-primary">Mã LĐ: </span> 1</p>
                                            </div>
                                        </div>
                                        <p>
                                            <span class="text-primary">Mã giá: </span> {{$item->ho_so->mcd->ma_muc_cap_dien}}
                                        </p>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                        <th>Bộ CS</th>
                                        <th>CHỈ SỐ CŨ</th>
                                        <th>CHỈ SỐ MƠI</th>
                                        <th>HS NHÂN</th>
                                        <th>ĐN TIÊU THỤ</th>
                                        <th>ĐN TRỰC TIẾP</th>
                                        <th>ĐN TRỪ PHỤ</th>
                                        <th>ĐN THỰC TẾ</th>
                                        <th>ĐƠN GIÁ</th>
                                        <th>THÀNH TIỀN</th>
                                        </thead>
                                        <tbody>
                                        @if($item->ho_so->mcd->loai_gia == 2)

                                            @php

                                                $giadien = $item->ho_so->mcd->giadien[0];
                                                    $chi_so_cu = json_decode($item->chi_so_cu);
                                                    $chi_so_moi = json_decode($item->chi_so_moi);

                                                $dn = (object)[
                                                    'bt' => $chi_so_moi->binh_thuong - $chi_so_cu->binh_thuong,
                                                    'cd' => $chi_so_moi->cao_diem - $chi_so_cu->cao_diem,
                                                    'td' => $chi_so_moi->thap_diem - $chi_so_cu->thap_diem,
                                                ];

                                                $price = (object)[
                                                    'bt' => $dn->bt * $giadien->binh_thuong,
                                                    'cd' => $dn->cd * $giadien->cao_diem,
                                                    'td' => $dn->td * $giadien->thap_diem,
                                                ];

                                            @endphp
                                            <tr>
                                                <td>BT</td>
                                                <td>{{$chi_so_cu->binh_thuong}}</td>
                                                <td>{{$chi_so_moi->binh_thuong}}</td>
                                                <td>1</td>
                                                <td>{{$dn->bt}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{$dn->bt}}</td>
                                                <td>{{$giadien->binh_thuong}}</td>
                                                <td>{{_price($price->bt)}}</td>
                                            </tr>
                                            <tr>
                                                <td>CD</td>
                                                <td>{{$chi_so_cu->cao_diem}}</td>
                                                <td>{{$chi_so_moi->cao_diem}}</td>
                                                <td>1</td>
                                                <td>{{$dn->cd}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{$dn->cd}}</td>
                                                <td>{{$giadien->cao_diem}}</td>
                                                <td>{{_price($price->cd)}}</td>
                                            </tr>
                                            <tr>
                                                <td>TD</td>
                                                <td>{{$chi_so_cu->thap_diem}}</td>
                                                <td>{{$chi_so_moi->thap_diem}}</td>
                                                <td>1</td>
                                                <td>{{$dn->td}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{$dn->td}}</td>
                                                <td>{{$giadien->thap_diem}}</td>
                                                <td>{{_price($price->td)}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-primary" colspan="7">Cộng:</td>
                                                <td class="font-weight-bold">{{array_sum(array_values((array)$dn))}}</td>
                                                <td></td>
                                                <td class="font-weight-bold">{{_price(array_sum(array_values((array)$price)))}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-primary" colspan="7">Thuế suất GTGT: 10%</td>
                                                <td class="text-primary" colspan="2">Thuế GTGT</td>
                                                <td class="font-weight-bold">{{_price(array_sum(array_values((array)$price))/10)}}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-weight-bold" colspan="9">Tổng cộng tiền thanh toán</td>
                                                <td>{{_price(array_sum(array_values((array)$price)) + (array_sum(array_values((array)$price))/10))}}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="10">
                                                    <span class="text-primary">Số tiền viết bằng chữ </span> <span
                                                            class="font-weight-bold">{{ucfirst(convert_number_to_words(array_sum(array_values((array)$price)) + (array_sum(array_values((array)$price))/10)))}}
                                                        đồng</span>
                                                </td>
                                            </tr>
                                        @elseif($item->ho_so->mcd->loai_gia == 1)
                                            <tr>
                                                <td>KT</td>
                                                <td>{{$item->chi_so_cu}}</td>
                                                <td>{{$item->chi_so_moi}}</td>
                                                <td>1</td>
                                                <td>{{$item->chi_so_moi - $item->chi_so_cu}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{$item->chi_so_moi - $item->chi_so_cu}}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            @php
                                                $prices = _priceKwh(($item->chi_so_moi - $item->chi_so_cu), $item->ho_so->mcd->giadien);
                                                $total = array_sum(array_column($prices, 'total'));
                                                $percent = $total/10;
                                            @endphp

                                            @foreach($prices as $price)
                                                @if($loop->first)
                                                    <tr>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td rowspan="{{sizeof($prices)}}"></td>
                                                        <td>{{$price['kwh']}}</td>
                                                        <td>{{_price($price['price'])}}</td>
                                                        <td>{{_price($price['total'])}}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>{{$price['kwh']}}</td>
                                                        <td>{{_price($price['price'])}}</td>
                                                        <td>{{_price($price['total'])}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            <tr>
                                                <td class="text-primary" colspan="7">Cộng:</td>
                                                <td class="font-weight-bold">{{$item->chi_so_moi - $item->chi_so_cu}}</td>
                                                <td></td>
                                                <td class="font-weight-bold">{{_price($total)}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-primary" colspan="7">Thuế suất GTGT: 10%</td>
                                                <td class="text-primary" colspan="2">Thuế GTGT</td>
                                                <td class="font-weight-bold">{{_price($percent)}}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-weight-bold" colspan="9">Tổng cộng tiền thanh toán</td>
                                                <td class="font-weight-bold">{{_price($total + $percent)}}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="10">
                                                    <span class="text-primary">Số tiền viết bằng chữ </span> <span
                                                            class="font-weight-bold">{{ucfirst(convert_number_to_words($total + $percent))}}
                                                        đồng</span>
                                                </td>
                                            </tr>
                                        @else

                                            @php
                                                $giadien = $item->ho_so->mcd->giadien[0];
                                                $dn = $item->chi_so_moi - $item->chi_so_cu;
                                                $price = $dn * $giadien->gia_dien;
                                            @endphp

                                            <tr>
                                                <td>KT</td>
                                                <td>{{$item->chi_so_cu}}</td>
                                                <td>{{$item->chi_so_moi}}</td>
                                                <td>1</td>
                                                <td>{{$item->chi_so_moi - $item->chi_so_cu}}</td>
                                                <td>0</td>
                                                <td>0</td>
                                                <td>{{$dn}}</td>
                                                <td>{{_price($giadien->gia_dien)}}</td>
                                                <td>{{_price($price)}}</td>
                                            </tr>

                                            <tr>
                                                <td class="text-primary" colspan="7">Thuế suất GTGT: 10%</td>
                                                <td class="text-primary" colspan="2">Thuế GTGT</td>
                                                <td class="font-weight-bold">{{_price($price/10)}}</td>
                                            </tr>

                                            <tr>
                                                <td class="font-weight-bold" colspan="9">Tổng cộng tiền thanh toán</td>
                                                <td class="font-weight-bold">{{_price($price + ($price/10))}}</td>
                                            </tr>

                                            <tr>
                                                <td colspan="10">
                                                    <span class="text-primary">Số tiền viết bằng chữ </span> <span
                                                            class="font-weight-bold">{{ucfirst(convert_number_to_words($price + ($price/10)))}}
                                                        đồng</span>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td colspan="10" class="text-right font-weight-bold">
                                                <p>Ngày ký: {{$item->created_at}}</p>
                                                <p>Người ký(Ông/Bà): Điện lực Thành Phố Vinh</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop
