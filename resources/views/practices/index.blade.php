@extends('main')

@section('stylesheets')

@endsection

@section('title', '| Exam')

@section('content')
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<h1>Practice</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th nowrap>試卷名稱</th>
						<th nowrap>試卷類型</th>
						<th nowrap>範圍</th>
						<th nowrap>題數</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
				@foreach($exams as $exam)
					<tr>
						<td>{{ $exam->name }}</td>
						<td>{{ config('custom.purpose')[$exam->purpose] }}</td>
						<td>
						@foreach(json_decode($exam->weights) as $weightId => $weight)
						<span class="label label-info">
							{{ App\Category::find($weightId)['name'] }}
						</span>&nbsp
						@endforeach
						</td>
						<td>{{ $exam->size }}</td>
						<td><a class="btn btn-primary btn-spacing" href="{{ route('practice.show', $exam->id) }}" role="button">看題庫</a></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection

