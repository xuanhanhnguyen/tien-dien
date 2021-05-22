@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script>
        $(function () {
            var label = "{{$label}}".split(',');
            var data = "{{$total}}".split(',');

            Chart.defaults.line.spanGaps = true;
            var areaChartData = {
                labels: label,
                datasets: [
                    {
                        label: "Điện năng tiêu thụ",
                        // backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: true,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        showLine: true,
                        data: data,

                    }

                ]
            };

            //
            // //-------------
            // //- BAR CHART -
            // //-------------
            var barChartCanvas = $('#day').get(0).getContext('2d');
            var barChartData = jQuery.extend(true, {}, areaChartData);

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return Math.round(value * 100) / 100 + 'kwh';
                            }
                        },
                    }]
                },
                elements: {
                    line: {
                        tension: 0, // disables bezier curves
                    }
                },
            };
            //
            new Chart(barChartCanvas, {
                type: 'line',
                data: barChartData,
                options: barChartOptions
            });
        });
    </script>
@stop

@section('content')
    @php
        $month = $month = date('m');
        $year = date('Y');
    @endphp
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">Thống kê</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thống kê</li>
            </ol>
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

        <form action="" method="get">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex align-items-center">
                        <label class="mb-0 mr-1 d-block" style="width: 55px" for="">Hồ sơ: </label>
                        <select class="form-control" name="dksd_id" id="">
                            @foreach($dksd as $item)
                                <option @if($dksd_id == $item->ma_dksd_dien) selected
                                        @endif value="{{$item->ma_dksd_dien}}">{{$item->ma_dksd_dien}}
                                    - {{$item->dia_chi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group d-flex align-items-center">
                        <label class="mb-0 mr-1" for="">Năm: </label>
                        <select class="form-control" name="nam" id="">
                            <option>{{$year}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" type="submit">Lọc</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h6>Thông kê chỉ số điện</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="day" style="height:230px; min-height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
