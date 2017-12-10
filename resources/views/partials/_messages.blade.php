@if(Session::has('success'))
	<div class="alert alert-success fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Success!</strong> {{ Session::get('success') }}
	</div>
@endif

@if(Session::has('warning'))
	<div class="alert alert-warning fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Warning!</strong> {{ Session::get('warning') }}
	</div>
@endif


@if(Session::has('failed'))
	<div class="alert alert-danger fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>failed!</strong> {{ Session::get('failed') }}
	</div>
@endif

@if(Session::has('aFailed'))
	<div class="alert alert-danger fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>failed! </strong>{{ Session::get('aFailed')['message'] }}
		<ul>
		@if(isset(Session::get('aFailed')['value']['p']))
			<p>Project Code</p>
			@foreach(Session::get('aFailed')['value']['p'] as $key => $error)
				<li>{{ $error }}</li>
			@endforeach
		@endif
		@if(isset(Session::get('aFailed')['value']['t']))
			<p>Testcase Code</p>
			@foreach(Session::get('aFailed')['value']['t'] as $key => $error)
				<li>{{ $error }}</li>
			@endforeach
		@endif
		</ul>
	</div>
@endif

@if(count($errors) > 0)
	<div class="alert alert-danger fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<strong>Errors</strong>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	</div>
@endif