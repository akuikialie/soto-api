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
                            Schedule
                            <span class="d-block text-muted pt-2 font-size-sm">This data based on API from <a href="https://www.sasbuzz.com/">sasbuzz</a></span>
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('dashboard.master.schedule.create') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <circle fill="#000000" cx="9" cy="15" r="6" />
                                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span> New Record
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Source</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Active</th>
                                    <th scope="col">Done</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $row)
                                    <tr>
                                        <th scope="row">{{ $row->id }}</th>
                                        <td>{{ $row->tag->name }}</td>
                                        <td>{{ $row->source }}</td>
                                        <td>{{ Carbon\Carbon::parse($row->date)->format('d F Y') }}</td>
                                        <td>
                                            @if ($row->active == 1)
                                                <span class="label label-success">&#10004;</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->done == 1)
                                                <span class="label label-success">&#10004;</span>
                                            @else
                                                <span class="label label-warning">&#10006;</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.master.schedule.detail', ['id' => $row->id]) }}"><button type="button" class="btn btn-sm btn-warning">View</button></a>
                                            <a href="{{ route('dashboard.master.schedule.sync', ['id' => $row->id]) }}"><button type="button" class="btn btn-sm btn-info">Sync</button></a>
                                            <!-- <button type="button" class="btn btn-sm btn-danger">Delete</button> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script>
</script>
@endsection