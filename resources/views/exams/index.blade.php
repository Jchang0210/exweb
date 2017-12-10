@extends('main')

@section('stylesheets')

@endsection

@section('title', '| Exam')

@section('content')
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<h1>Exams</h1>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
			<a class="btn btn-primary btn-spacing" href="{{ route('exam.create') }}" role="button">New Exam</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th nowrap>#</th>
						<th nowrap>name</th>
						<th nowrap>purpose</th>
						<th nowrap>題數</th>
						<th nowrap>weight</th>
						<th nowrap>create at</th>
						<th></th>
						<th></th>
						<th></th>
						{{-- <th></th> --}}
					</tr>
				</thead>

				<tbody>
				@foreach($exams as $exam)
					<tr>
						<td>{{ $exam->id }}</td>
						<td nowrap>{{ $exam->name }}</td>
						<td nowrap>{{ config('custom.purpose')[$exam->purpose] }}</td>
						<td>{{ $exam->size }}</td>
						<td>
						@foreach(json_decode($exam->weights) as $weightId => $weight)
						<span class="label label-info">
							{{ App\Category::find($weightId)['name'] }} : {{ $weight }}%
						</span>&nbsp
						@endforeach
						</td>
						<td nowrap>{{ date('M j, Y', strtotime($exam->created_at)) }}</td>

						{{-- release exam --}}
						<td nowrap>
						@if($exam->release == 0)
							<form action="{{ route('exam.release', [$exam->id,1]) }}" method="POST" role="form" style="display: inline;">
								<input type="hidden" name="_method" value="PUT">
								{{ csrf_field() }}

								<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#release{{ $exam->id }}">發佈</button>

								<div class="modal fade" id="release{{ $exam->id }}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body"><b>是否確定發佈 {{ $exam->name }}</b></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
												<button type="submit" class="btn btn-primary">確定</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						@else
							<form action="{{ route('exam.release', [$exam->id,0]) }}" method="POST" role="form" style="display: inline;">
								<input type="hidden" name="_method" value="PUT">
								{{ csrf_field() }}

								<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#release{{ $exam->id }}">結束</button>

								<div class="modal fade" id="release{{ $exam->id }}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body"><b>是否確定結束 {{ $exam->name }}</b></div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
												<button type="submit" class="btn btn-primary">確定</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						@endif
							{{-- Edit and Delete --}}
							<form action="{{ route('exam.destroy', $exam->id) }}" method="POST" role="form" style="display: inline;">
								<a class="btn btn-xs btn-primary" href="{{ route('exam.edit', $exam->id ) }}" role="button">編輯</a>
								<input type="hidden" name="_method" value="DELETE">
								{{ csrf_field() }}

								<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete{{ $exam->id }}">刪除</button>

								<div class="modal fade" id="delete{{ $exam->id }}" tabindex="-1" role="dialog">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-body"><b>是否確定刪除 {{ $exam->name }}</b></div>
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
	</div>

@endsection

