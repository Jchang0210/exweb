@extends('main')

@section('stylesheets')

@endsection

@section('title', '| edit')

@section('content')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
			<h1>Edit Category</h1>
			<hr>

			<form action="{{ route('category.update', $category->id) }}" method="POST" role="form" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="">Category</label>
					<input type="text"  name="name" class="form-control" id="" placeholder="Company Name..." value="{{ $category->name }}" autofocus>
				</div>
				<br>
				<button type="submit" class="btn btn-primary">Update</button>
			</form>

		</div>
	</div>

@endsection

