<nav class="navbar navbar-expand-md navbar-light text-light" style="background-color:#FF8C00">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    <i class="fa fa-air-freshener" aria-hidden="true"></i> Roesman Store </a>
                    <!-- 
                    <div class="navbar-nav ">
                        <li class="nav-item dropdown">
                            <a class="nav-link text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-list">Category</i>
                        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('products') }}" class="nav-link">Osprey</a>
                                </a>
                                <a class="dropdown-item" href="{{ url('products') }}" class="nav-link">Eiger</a>
                        </li>
                    </div> -->
                <div class="input-group" style="width:400px;">
                  <input placeholder="Search..." type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                  <div class="input-group-append">
                        <button class="btn btn-secondary btn-sm" type="submit"><i class="fa fa-search" aria-hidden="true"></i>Search</button>
                  </div>
              </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a href="{{ route('carts.index') }}" class=" text-light nav-link"> 
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                             Cart <span class="bagde badge-pill badge-warning">
                             @if(session('cart')) 
                                {{ count(session('cart')) }}
                             @else 0
                                @endif
                            </span>
                         </a>
                    </li>@if (Auth::check())
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                        Product
                        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.products.index')
                        }}">List</a>
                                <a class="dropdown-item" href="{{ route('user.products.create')
                        }}">Tambah</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            Order
                        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('user.orders.index')}}" class="nav-link">List</a>
                        </li>

                        @endif<!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">
                             <i class="fa fa-user" aria-hidden="true"></i> {{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">
                             <i class="fa fa-sign-in-alt" aria-hidden="true"></i> {{ __('Register') }}</a>
                        </li>
                        @endif @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="text-light nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fa fa-sign-out-alt" aria-hidden="true"></i> {{ __('Logout') }}
                                    </a>

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
        