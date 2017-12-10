@extends('main')

@section('stylesheets')

@endsection

@section('title', '| edit')

@section('content')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
			<h1>Edit Question</h1>
			<hr>

			<form action="{{ route('question.update', $question->id) }}" method="POST" role="form" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="">Purpose</label>
					<select name="purpose" class="form-control">
						<option value=""></option>
						@foreach(config('custom.purpose') as $key => $purpose)
							@if($key == $question->purpose)
								<option value="{{ $key }}" selected>{{ $purpose }}</option>
							@else
								<option value="{{ $key }}">{{ $purpose }}</option>
							@endif
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="">Type</label>
					<select name="type" class="form-control">
						<option value=""></option>
						@foreach(config('custom.question_type') as $key => $type_name)
							@if($key == $question->type)
								<option value="{{ $key }}" selected>{{ $type_name }}</option>
							@else
								<option value="{{ $key }}">{{ $type_name }}</option>
							@endif
						@endforeach
					</select>
				</div>

				<div class="form-group">

					<label for="">Question</label>
					<textarea type="text" name="question" class="form-control" id="" rows="5" placeholder="Something remenber...">{{ $question->question }}</textarea>

					<label for="">Answer</label>
					<input type="text"  name="answer" class="form-control" id="" value="{{ $question->answer }}">
				</div>

				<div class="form-group">
					<label for="">Option1</label>
					<input type="text"  name="option1" class="form-control" id="" value="{{ $question->option1 }}">
					<label for="">Option2</label>
					<input type="text"  name="option2" class="form-control" id="" value="{{ $question->option2 }}">
					<label for="">Option3</label>
					<input type="text"  name="option3" class="form-control" id="" value="{{ $question->option3 }}">
					<label for="">Option4</label>
					<input type="text"  name="option4" class="form-control" id="" value="{{ $question->option4 }}">
					<label for="">Option5</label>
					<input type="text"  name="option5" class="form-control" id="" value="{{ $question->option5 }}">
				</div>

				<button type="submit" class="btn btn-primary">Update</button>
			</form>

		</div>
	</div>

@endsection

