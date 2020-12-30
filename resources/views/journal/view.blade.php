@extends('template')

@section('content')
<div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
	<div class="login-wrapper">
		<!--begin:Sign In Form-->
		<div class="login-signin">
			<div class="text-center mb-10 mb-lg-20">
				<h2 class="font-weight-bold">Create journal</h2>
				<p class="text-muted font-weight-bold">Enter your transaction</p>
			</div>
			@if(session('errors'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Something it's wrong:
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>
			@endif
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message') }}
				</div>
			@endif
			@if(session()->has('error'))
				<div class="alert alert-danger">
					{{ session()->get('error') }}
				</div>
			@endif
			<form class="form text-left" id="kt_login_signin_form" method="post" action="{{ route('journal.update', ['id' => $journal->id]) }}">
				<input type="hidden" name="_method" value="PUT">
				@csrf
				<div class="form-group py-2 border-top m-0">
					<label for="sel1">Nama Journal:</label>
					<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text"
						name="name" value="{{ $journal->name }}"/>
				</div>
				<div class="form-group py-2 border-top m-0">
					<label for="sel1">Deskripsi:</label>
					<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text"
						name="description" value="{{ $journal->description }}"/>
				</div>
				<div class="text-center mt-15">
					<button id="kt_login_signin_submit"
						class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold">Save</button>
				</div>
			</form>
		</div>
		<!--end:Sign In Form-->
	</div>
</div>
@endsection