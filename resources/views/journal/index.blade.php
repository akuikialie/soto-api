@extends('template')

@section('content')
<div class="d-flex w-100 flex-center p-25 position-relative overflow-hidden">
	<div class="table-responsive">
		<p>
			<h3>Daftar Jurnal</h3>
		</p>
		<table class="table table-striped">
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Description</th>
				<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($datas as $row)
				<tr>
					<th scope="row"></th>
					<td>{{ $row->name }}</td>
					<td>{{ $row->description }}</td>
					<td>
						<a href="{{ route('journal.view', ['id' => $row->id])}}">
							<button type="button" class="btn btn-warning">View</button>
						</a>
						<!-- <a href="{{ route('journal.delete', ['id' => $row->id])}}">
							<button type="button" class="btn btn-danger">Delete</button>
						</a> -->
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection