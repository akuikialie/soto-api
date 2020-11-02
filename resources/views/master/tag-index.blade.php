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
                            Tag
                            <span class="d-block text-muted pt-2 font-size-sm">This data based on API from <a href="https://www.sasbuzz.com/">sasbuzz</a></span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Key</th>
                                    <th scope="col">IG Account</th>
                                    <th scope="col">TW Account</th>
                                    <th scope="col">YT Account</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $row)
                                    <tr>
                                        <th scope="row">{{ $row->id }}</th>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->key }}</td>
                                        <td>{{ $row->instagram_account }}</td>
                                        <td>{{ $row->twitter_account }}</td>
                                        <td>{{ $row->youtube_account }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.master.tag.detail', ['id' => $row->id]) }}"><button type="button" class="btn btn-sm btn-warning">View</button></a>
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