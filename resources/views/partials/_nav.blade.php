<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Readi</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li class="{{ Request::is('/') ? "active" : "" }}"><a href="/">Home</a></li>
				<li class="{{ Request::is('category') ? "active" : "" }}"><a href="/category">Categories</a></li>
				<li class="{{ Request::is('question') ? "active" : "" }}"><a href="/question">Questions</a></li>
				<li class="{{ Request::is('exam') ? "active" : "" }}"><a href="/exam">Exam</a></li>
				<li class="{{ Request::is('practice') ? "active" : "" }}"><a href="/practice">Practice</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
			@if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
			@else
				<li class="dropdown">

					<a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="flase">Hello {{ Auth::user()->name }} <span class="caret"></span></a>

					<ul class="dropdown-menu">
						<li>
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
		                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                        {{ csrf_field() }}
		                    </form>
	                    </li>
					</ul>
				</li>
			@endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>