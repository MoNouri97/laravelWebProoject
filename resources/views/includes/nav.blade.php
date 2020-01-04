<nav class="navbar navbar-expand-md   
@hasSection ('hero')
navbar-dark  
@else
navbar-light
@endif" id="nav">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
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
                <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    
                    <form class="form-inline my-2 my-lg-0" method="POST" action="/posts/tags" >
                        @csrf
                        <input class="form-control mr-sm-2" 
                        type="text" 
                        name="tags"
                        placeholder="Search for tags" 
                        aria-label="Search">
                        <button class="btn btn-outline-default" type="submit" >
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
                                <a class="dropdown-item" href="/dashboard">Dashboard</a>
                                <a class="dropdown-item" href="/posts/create">Create Post</a>
                            @endif
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
