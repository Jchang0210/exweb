@extends('main')

@section('stylesheets')

@endsection

@section('title', '| create')

@section('content')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">

			<hr>
			<form action="{{ route('exam.store') }}" method="POST" role="form" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">試卷名稱</label>
					<div class="col-sm-10">
						<input type="text"  name="name" class="form-control" placeholder="Exam Name..." autofocus>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">考試類型</label>
					<div class="col-sm-10">
						<select name="purpose" class="form-control">
						<option value=""></option>
						@foreach(config('custom.purpose') as $key => $purpose)
						<option value="{{ $key }}">{{ $purpose }}</option>
						@endforeach
					</select>
					</div>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label">題數</label>
					<div class="col-sm-2">
						<input type="text"  name="size" class="form-control">
					</div>
				</div>
				@foreach($categories as $category)
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">{{$category->name}}</label>
						<div class="col-sm-2">
							<input type="text" name="weights[{{$category->id}}]" class="form-control">
						</div>
					</div>
				@endforeach

				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>

			</form>
		</div>
	</div>

@endsection

