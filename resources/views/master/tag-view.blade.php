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
                            Tag View
                            <span class="d-block text-muted pt-2 font-size-sm">This data based on API from <a href="https://www.sasbuzz.com/">sasbuzz</a></span>
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('dashboard.master.tag.update', ['id' => $data->id]) }}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Code</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->code }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Key</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->key }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Target</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->target->name }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Instagram Account</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->instagram_account }}" name="instagram_account">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Twitter Account</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->twitter_account }}" name="twitter_account">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Youtube Account</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="{{ $data->youtube_account }}" name="youtube_account">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                            <a href="{{ route('dashboard.master.tag.index') }}"><button type="button" class="btn btn-info">Back</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
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