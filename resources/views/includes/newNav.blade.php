
<div class="site-mobile-menu site-navbar-target">
	<div class="site-mobile-menu-header">
		<div class="site-mobile-menu-close mt-3">
			<span class="icofont-close js-menu-toggle"></span>
		</div>
	</div>
	<div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar js-sticky-header site-navbar-target" role="banner" >

	<div class="container">
		<div class="row align-items-center">
			
			<div class="col-6 col-lg-2">
				<h1 class="mb-0 site-logo"><a href="index.html" class="mb-0">SoftLand</a></h1>
			</div>

			<div class="col-12 col-md-10 d-none d-lg-block">
				<nav class="site-navigation position-relative text-right" role="navigation">

					<ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
						<li class="nav-item"><a href="/posts" class="nav-link">All Posts</a></li>
                @auth
                    @if (Auth::user()->type == "admin")
                        <li class="nav-item">
                            <a class="nav-link" href="/users">
                                All Users
                                <span class="badge badge-danger">admin</span>
                            </a>
                        </li>
                    @endif
								@endauth
								<li class="nav-item">
                    
									<form class="form-inline my-2 my-lg-0" method="POST" action="/posts/tags" >
											@csrf
											<input class="form-control mr-sm-2" 
											type="text" 
											name="tags"
											placeholder="Search for tags" 
											aria-label="Search">
											<button class="btn btn-outline-default" type="submit">
													<span class="fas fa-search"></span>
											</button>
										</form>
							</li>
							<!-- Authentication Links -->
							@guest
									<li class="nav-item">
											<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
									</li>
									@if (Route::has('register'))
											<li class="nav-item">
													<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
											</li>
									@endif
							@else
									<li class="nav-item dropdown">
											<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
												 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
													{{ Auth::user()->name }} <span class="caret"></span>
											</a>

											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
													<a class="dropdown-item" href="{{ route('logout') }}"
														 onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
															{{ __('Logout') }}
													</a>
													<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
															@csrf
													</form>
													@if (Auth::user()->type === 'admin'||Auth::user()->type === 'writer')
															<a class="dropdown-item" href="/home">Dashboard</a>
															<a class="dropdown-item" href="/posts/create">Create Post</a>
													@endif
											</div>
									</li>
							@endguest
						
						<li class="has-children active">
							<a href="blog.html" class="nav-link">Blog</a>
							<ul class="dropdown">
								<li><a href="blog.html" class="nav-link active">Blog</a></li>
								<li><a href="blog-single.html" class="nav-link">Blog Sigle</a></li>
							</ul>
						</li>
						<li><a href="contact.html" class="nav-link">Contact </a></li>
					</ul>
				</nav>
			</div>


			<div class="col-6 d-inline-block d-lg-none ml-md-0 py-3" style="position: relative; top: 3px;">

				<a href="#" class="burger site-menu-toggle js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
			</div>

		</div>
	</div> 
</header>