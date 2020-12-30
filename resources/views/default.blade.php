@extends('template')

@section('content')
<div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
	<div style="border:2px black solid;padding:25px">
		<div class="row">
			<div class="col-md-12">
				<h4>Transaksi</h4>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-6">
				<a href="{{ route('transaction.create') }}">
					<button type="button" class="btn btn-primary btn-lg">Buat</button>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('transaction.index') }}">
					<button type="button" class="btn btn-primary btn-lg">Data</button>
				</a>
			</div>
		</div>
	</div>
	<div style="border:2px black solid;padding:25px;margin:5px">
		<div class="row">
			<div class="col-md-12">
				<h4>Absensi</h4>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-6">
				<a href="{{ route('transaction.create') }}">
					<button type="button" class="btn btn-primary btn-lg">Buat</button>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('transaction.index') }}">
					<button type="button" class="btn btn-primary btn-lg">Data</button>
				</a>
			</div>
		</div>
	</div>
	<div style="border:2px black solid;padding:25px;margin:5px">
		<div class="row">
			<div class="col-md-12">
				<h4>Vendor</h4>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-6">
				<a href="{{ route('vendor.create') }}">
					<button type="button" class="btn btn-primary btn-lg">Buat</button>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('vendor.index') }}">
					<button type="button" class="btn btn-primary btn-lg">Data</button>
				</a>
			</div>
		</div>
	</div>
	<div style="border:2px black solid;padding:25px;margin:5px">
		<div class="row">
			<div class="col-md-12">
				<h4>Journal</h4>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-6">
				<a href="{{ route('journal.create') }}">
					<button type="button" class="btn btn-primary btn-lg">Buat</button>
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('journal.index') }}">
					<button type="button" class="btn btn-primary btn-lg">Data</button>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection