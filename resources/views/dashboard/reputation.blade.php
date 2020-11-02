@extends('template')

@section('content')
<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">
                            Reputation
                            <span class="d-block text-muted pt-2 font-size-sm">This data based on API from <a href="https://www.sasbuzz.com/">sasbuzz</a></span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <!-- <a href="{{ route('dashboard.master.schedule.create') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span> New Record
                        </a> -->
                    </div>
                </div>
                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="col-lg-12">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <!--begin::Header-->
                            <div class="card-header h-auto">
                                <!--begin::Title-->
                                <div class="card-title py-5">
                                    <h3 class="card-label">
                                        Line Chart
                                    </h3>
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <div class="card-body">
                                <!--begin::Chart-->
                                <div id="chart_1"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection

@section('footer-script')
<!--begin::Page Scripts(used by this page)-->
<script>
var options = {
    series: [{
        name: "Desktops",
        data: [
            10, 41, 35, 51, 49, 62, 69, 91, 148
        ]
    }],
    chart: {
        height: 350,
        type: 'line',
        zoom: {
            enabled: false
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'straight'
    },
    title: {
        text: '{{ $title }}',
        align: 'center'
    },
    grid: {
        row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
        },
    }
    // xaxis: {
    //     categories: [
    //         'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'
    //     ],
    // }
};

var chart = new ApexCharts(document.querySelector("#chart_1"), options);
// var url = 'http://my-json-server.typicode.com/apexcharts/apexcharts.js/yearly';
var url = "{{ route('dashboard.reputation-data') }}";

$.getJSON(url, function(response) {
  chart.updateSeries([{
    name: 'Sales',
    data: response
  }])
});
chart.render();
</script>
@endsection