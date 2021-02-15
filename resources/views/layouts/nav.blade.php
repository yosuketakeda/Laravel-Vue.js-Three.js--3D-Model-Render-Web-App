<nav class="navbar navbar-expand-lg navbar-primary bg-white">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-menu">
        <a class="navbar-brand" href="{{route('dashboard')}}">
            <img src="{{ asset('images/logo.png') }}" class="logo" />
        </a>
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0 align-items-baseline">
            <li class="nav-item ml-2">
                <a class="nav-link" href="#">Notifications</a>
            </li>
            <li class="nav-item ml-2">
                <a class="nav-link" href="{{route('orderHistory')}}">History</a>
            </li>
            <li class="nav-item active ml-2"> 
                <a class="nav-link" href="{{route('dashboard')}}">Order Now</a>
            </li>
            
            <li class="nav-item ml-2">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#">
                    {{ Auth::user()->name }}
                    <!--<i class="fa fa-chevron-down"></i>-->
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
                </div>
            </li>            
        </ul>
    </div>
</nav> 