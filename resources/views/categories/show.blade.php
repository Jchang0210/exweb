@extends('main')

@section('title', "| $category->name")

@section('content')
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			<h1>{{ $category->name }} <small>{{ $category->question->count() }} Questions</small></h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th nowrap>#</th>
						<th nowrap>type</th>
						<th nowrap>question</th>
						<th nowrap>answer</th>
						<th nowrap>option1</th>
						<th nowrap>option2</th>
						<th nowrap>option3</th>
						<th nowrap>option4</th>
						<th nowrap>option5</th>
						<th nowrap>create at</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($questions as $question)
					<tr>
						<td>{{ $question->id }}</td>
						<td>{{ config('custom.question_type')[$question->type] }}</td>
						<td>{{ $question->question }}</td>
						<td>{{ $question->answer }}</td>
						<td>{{ $question->option1 }}</td>
						<td>{{ $question->option2 }}</td>
						<td>{{ $question->option3 }}</td>
						<td>{{ $question->option4 }}</td>
						<td>{{ $question->option5 }}</td>
						<td>{{ date('M j, Y', strtotime($question->created_at)) }}</td>
						<td>
							<a class="btn btn-xs btn-primary" href="{{ route('question.edit', $question->id ) }}" role="button">編輯</a>

							<form action="{{ route('question.destroy', $question->id) }}" method="POST" role="form">
								<input type="hidden" name="_method" value="DELETE">
								{{ csrf_field() }}

								<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#{{ $question->id }}">刪除</button>

								<div class="modal fade" id="{{ $question->id }}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body"><b>是否確定刪除 {{ $question->question }}</b></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
												<button type="submit" class="btn btn-primary">確定</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>

		<div class="text-center">
			{{ $questions->links() }}
		</div>
	</div>

@endsection