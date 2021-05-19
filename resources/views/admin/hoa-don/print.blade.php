@extends('admin.layouts.print')


@section('content')
    <div class="container hd-print">
        <div class="col-md-8">
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
                                class="font-weight-bold">{{$hd->ho_so->kh->name}}</span></p>
                    <p><span class="text-primary">Địa chỉ: </span> <span
                                class="font-weight-bold">{{$hd->ho_so->kh->address}}</span>
                    </p>
                    <div class="row">
                        <div class="col-4">
                            <p><span class="text-primary">SĐT: </span> <span
                                        class="font-weight-bold">{{$hd->ho_so->kh->phone}}</span>
                        </div>
                        <div class="col-4">
                            <p><span class="text-primary">MST: </span> <span
                                        class="font-weight-bold">1010010041717 - 017</span>
                        </div>
                        <div class="col-2">
                            <p>
                                <span class="text-primary">Số công tơ: </span>{{$hd->ho_so->ma_dksd_dien}}
                            </p>
                        </div>
                        <div class="col-2">
                            <p><span class="text-primary">Số hộ: </span> 1</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p><span class="text-primary">Mã KH: </span> <span
                                        class="font-weight-bold text-danger">{{$hd->ho_so->ma_khach_hang}}</span>
                        </div>
                        <div class="col-4">
                            <p><span class="text-primary">Mã HD: </span> <span
                                        class="font-weight-bold text-danger">{{$hd->ma_hoa_don}}</span>
                        </div>
                        <div class="col-2">
                            <p>
                                <span class="text-primary">Mã KV: </span>{{$hd->ho_so->kv->ma_khu_vuc}}
                            </p>
                        </div>
                        <div class="col-2">
                            <p><span class="text-primary">Mã LĐ: </span> 1</p>
                        </div>
                    </div>
                    <p>
                        <span class="text-primary">Mã giá: </span> {{$hd->ho_so->mcd->ma_muc_cap_dien}}
                    </p>
                </div>

                <table class="table table-bordered">
                    <thead>
                    <tr>
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
                    </tr>
                    </thead>
                    <tbody>
                    @if($hd->ho_so->mcd->loai_gia == 2)

                        @php

                            $giadien = $hd->ho_so->mcd->giadien[0];
                                $chi_so_cu = json_decode($hd->chi_so_cu);
                                $chi_so_moi = json_decode($hd->chi_so_moi);

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
                    @elseif($hd->ho_so->mcd->loai_gia == 1)
                        <tr>
                            <td>KT</td>
                            <td>{{$hd->chi_so_cu}}</td>
                            <td>{{$hd->chi_so_moi}}</td>
                            <td>1</td>
                            <td>{{$hd->chi_so_moi - $hd->chi_so_cu}}</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{{$hd->chi_so_moi - $hd->chi_so_cu}}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @php
                            $prices = _priceKwh(($hd->chi_so_moi - $hd->chi_so_cu), $hd->ho_so->mcd->giadien);
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
                            <td class="font-weight-bold">{{$hd->chi_so_moi - $hd->chi_so_cu}}</td>
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
                            $giadien = $hd->ho_so->mcd->giadien[0];
                            $dn = $hd->chi_so_moi - $hd->chi_so_cu;
                            $price = $dn * $giadien->gia_dien;
                        @endphp

                        <tr>
                            <td>KT</td>
                            <td>{{$hd->chi_so_cu}}</td>
                            <td>{{$hd->chi_so_moi}}</td>
                            <td>1</td>
                            <td>{{$hd->chi_so_moi - $hd->chi_so_cu}}</td>
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
                            <p>Ngày ký: {{$hd->created_at}}</p>
                            <p>Người ký(Ông/Bà): Điện lực Thành Phố Vinh</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop