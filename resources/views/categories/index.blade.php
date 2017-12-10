@extends('main')

@section('stylesheets')

@endsection

@section('title', '| Categories')

@section('content')
	<div class="row">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
			<h1>Categories</h1>
		</div>
		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
			<a class="btn btn-primary btn-spacing" href="{{ route('category.create') }}" role="button">New Category</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th nowrap>#</th>
						<th nowrap>name</th>
						<th nowrap>count</th>
						<th nowrap>create at</th>
						<th></th>
						<th></th>
						{{-- <th></th> --}}
					</tr>
				</thead>

				<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{ $category->id }}</td>
						<td><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></td>
						<td>{{ $category->question->count() }}</td>

						<td>{{ date('M j, Y', strtotime($category->created_at)) }}</td>
						<td>
						<form action="{{ route('category.destroy', $category->id) }}" method="POST" role="form">
							{{ csrf_field() }}

							<a class="btn btn-xs btn-primary" href="{{ route('category.edit', $category->id ) }}" role="button">編輯</a>
							<input type="hidden" name="_method" value="DELETE">

							<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#{{ $category->id }}">刪除</button>

							<div class="modal fade" id="{{ $category->id }}" tabindex="-1" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h4><b>是否確定刪除 {{ $category->name }}</b></h4>
										</div>
										<div class="modal-body"><p class="text-danger">{{ $category->name }} 包含<b><big> {{ $category->question->count() }} </big></b>個題目，將會連帶刪除</p></div>

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

