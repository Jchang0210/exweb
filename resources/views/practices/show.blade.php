@extends('main')

@section('title', "| Practice")

@section('content')
	<div class="row">
		<div class="col-md-4 col-lg-4">
			<font size="6">{{ $exam->name }}</font>
		</div>
		<div class="col-md-1 col-lg-1 col-md-offset-7 col-lg-offset-7" style="padding-top: 20px">
			<a class="btn btn-xs btn-success" href="{{ route('practice.getword') }}" role="button">匯出</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th nowrap>#</th>
						<th nowrap>題型</th>
						<th nowrap>題目</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@php($i=0)

					@foreach($questions as $question)
					@php($i++)
					<tr>
						<td>{{ $i }}</td>
						<td nowrap>{{ config('custom.question_type')[$question['type']] }}</td>
						<td>{{ $question['question'] }}<br>

							@if($question['type'] == 2)
							(A) <b>{{ $question['option1'] }}</b>
							(B) <b>{{ $question['option2'] }}</b>
							(C) <b>{{ $question['option3'] }}</b>
							(D) <b>{{ $question['option4'] }}</b>
								@if($question['option5'] != "")
								(E) <b>{{ $question['option5'] }}</b>
								@endif
							@endif
						</td>
						<td nowrap>
							<br><small>{{ App\Category::find($question['category_id'])['name'] }}</small>
						</td>
						<td>
							<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#{{ $question['id'] }}">?</button>
							<div class="modal fade" id="{{ $question['id'] }}" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-body">答案為: <b>{{ $question['answer'] }}</b></div>
									</div>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection