@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script>
        $(function () {
            Chart.defaults.line.spanGaps = true;
            var areaChartData = {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [
                    {
                        label: 'Doanh thu(đ)',
                        // backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: true,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        showLine: true,
                        lineWidth: 1,
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10]
                    }

                ]
            };

            //
            // //-------------
            // //- BAR CHART -
            // //-------------
            var barChartCanvas = $('#day').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        stacked: true
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
            })
            //
            //
            // //==============================
            // var bg = ['#3b8bba', '#f70307', '#06a019'];
            // var day_datasets = [];
            // for (var i = 0; i < data.day.length; i++) {
            //     day_datasets = [...day_datasets, {
            //         label: data.day[i].ten_sp,
            //         backgroundColor: bg[i],
            //         borderColor: bg[i],
            //         pointRadius: false,
            //         pointColor: bg[i],
            //         pointStrokeColor: 'rgba(60,141,188,1)',
            //         pointHighlightFill: '#fff',
            //         pointHighlightStroke: 'rgba(60,141,188,1)',
            //         data: [parseFloat(data.day[i].ttien)]
            //     }]
            // }
            //
            // var day = {
            //     labels: ["Doanh thu(đ)"],
            //     datasets: day_datasets
            // };
            // //
            // // //-------------
            // // //- BAR CHART -
            // // //-------------
            // var barChartCanvas1 = $('#day').get(0).getContext('2d')
            // var barChartData1 = jQuery.extend(true, {}, day)
            //
            // var barChartOptions1 = {
            //     responsive: true,
            //     maintainAspectRatio: false,
            //     datasetFill: false
            // }
            // //
            // new Chart(barChartCanvas1, {
            //     type: 'bar',
            //     data: barChartData1,
            //     options: barChartOptions1
            // })

            //    ========================================
            //==============================
            // var mon_datasets = [];
            // for (var i = 0; i < data.mon.length; i++) {
            //     mon_datasets = [...mon_datasets, {
            //         label: data.mon[i].ten_sp,
            //         backgroundColor: bg[i],
            //         borderColor: bg[i],
            //         pointRadius: false,
            //         pointColor: bg[i],
            //         pointStrokeColor: 'rgba(60,141,188,1)',
            //         pointHighlightFill: '#fff',
            //         pointHighlightStroke: 'rgba(60,141,188,1)',
            //         data: [parseFloat(data.mon[i].ttien)]
            //     }]
            // }

            // var mon = {
            //     labels: ["Doanh thu(đ)"],
            //     datasets: mon_datasets
            // };
            //
            // //-------------
            // //- BAR CHART -
            // //-------------
            // var barChartCanvas2 = $('#mon').get(0).getContext('2d')
            // var barChartData2 = jQuery.extend(true, {}, mon)

            // var barChartOptions2 = {
            //     responsive: true,
            //     maintainAspectRatio: false,
            //     datasetFill: false
            // }
            //
            // new Chart(barChartCanvas2, {
            //     type: 'bar',
            //     data: barChartData2,
            //     options: barChartOptions2
            // })
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
            <h3 class="page-title">Điện kế</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Điện kế</li>
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
                <div class="col-md-3">
                    <div class="form-group d-flex align-items-center">
                        <label class="mb-0 mr-1" for="">Tháng: </label>
                        <select class="form-control" name="thang" id="">
                            @if(!isset($_GET['thang']))
                                @for($i = 1; $i<13;$i++)
                                    <option @if($month == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            @else
                                @for($i = 1; $i<13;$i++)
                                    <option @if($_GET['thang'] == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            @endif
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
                        <h6>Thông kê khách hàng theo trạng thái</h6>
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
