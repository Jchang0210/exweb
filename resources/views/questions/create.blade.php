@extends('main')

@section('title', '| create')

@section('content')
    <div class="row row-full">
        <div class="col-md-12">
			<form action="{{ route('question.store') }}" method="POST" role="form" enctype="multipart/form-data">
			{{ csrf_field() }}

				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<label for="">考試類型</label>
					<select name="purpose" class="form-control">
						<option value=""></option>

						@foreach(config('custom.purpose') as $key => $purpose)
						<option value="{{ $key }}">{{ $purpose }}</option>
						@endforeach
					</select>

					<label for="">Category</label>
					<select name="category" class="form-control">
						<option value=""></option>
						@foreach($categories as $categorie)
						<option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p>File :</p>
					<input type="file" name="imported_file"/>
					<br /><br />
					<input type="submit" value="Upload" />
				</div>
			</form>
        </div>
    </div> <!-- end of header .row -->
@endsection