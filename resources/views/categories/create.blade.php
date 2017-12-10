@extends('main')

@section('stylesheets')

@endsection

@section('title', '| create')

@section('content')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
			<h1>Create New Category</h1>
			<hr>

			<form action="{{ route('category.store') }}" method="POST" role="form" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">

					<label for="">Category</label>
					<input type="text"  name="name" class="form-control" id="" placeholder="Category Name..." autofocus>

				</div>
				<br>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>

		</div>
	</div>

@endsection

