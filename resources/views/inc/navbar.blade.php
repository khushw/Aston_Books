
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <i class="fa fa-book fa-4x" aria-hidden="true"></i>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <a class = "nav-link" href='/'> Home</a>    
                    <a class = "nav-link" href='/about'> About</a>
                    <a class = "nav-link" href='/carts'> Cart 

                        {{-- display the total number of items in the shopping cart, we dont want to display a 0 so added an if statement --}}
                        <span class="cart-count">
                            @if (Cart::instance('default')->count() > 0 )
                            <span>{{ Cart::instance('default')->count() }}
                            </span>
                            @endif
                        </span>
                    </a>

                    <!-- Below code creates the dropwdown carrot to view books, create books and buy books -->
                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href='#' role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Products <span class="caret"></span>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href='/products'>
                                  Books on Sale  
                                </a>
                                 <a class="dropdown-item" href='/products/create'>
                                  Sell Books  
                                </a>
                            </div>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#"></a>
                        </li>
                        {{-- below is notifactions dropdown --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-bell"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#"> Notify</a>
                            </div>
                        </li>
                        {{-- above is test nav bar --}}
                        {{-- below is normal nav bar  --}}

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                @can('manage-users')
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}" > User Management </a>
                                <a class="dropdown-item" href="{{ route('categories.index') }}" > Manage Categories </a>
                                <a class="dropdown-item" href="{{ route('conditions.index') }}" > Manage Conditions </a>
                                @endcan
                                <a class="dropdown-item" href="{{ route('orders.index') }}" > My Orders </a>
                                <a class="dropdown-item" href="{{ route('listings.index') }}" > Sold Items </a>
                                <a class="dropdown-item" href="{{ route('forsale.index') }}" > My Products </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
