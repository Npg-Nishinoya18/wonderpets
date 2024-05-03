<!-- //views/partials/_header.blade.php -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
    <ul class="navbar-nav ms-auto">
    @guest
    <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="{{url()->previous()}}" class="btn btn-success" role="button">Back</a>
        </li>

        @if (Route::has('user.signin'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.signin') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('user.signup'))
            <li class="nav-item">
                <a class="nav-link" href="{{route('user.signup')}}">{{ __('Register') }}</a>
            </li>
        @endif

        <li>
            <a href="{{ route('groomingtransaction.shoppingCart') }}">
                <i class="fa fa-paw" aria-hidden="true"></i> Chosen Service
                <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
            </a>
        </li>
    </ul>
    @else
            <?php if(Auth::user()->role == 'Customer'): ?>
                <a class="navbar-brand" href="{{ route('customer.profile') }}">HOME</a>  
            <?php else: ?>
                <a class="navbar-brand" href="{{ route('home') }}">HOME</a>
            <?php endif; ?>
            <a class="navbar-brand" href="{{ route('groomingtransaction.index') }}">| WONDERPETS GROOMING SERVICES</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('groomingtransaction.shoppingCart') }}">
                        <i class="fa fa-paw" aria-hidden="true"></i> Chosen Service
                        <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" clyass="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span
                                class="caret"></span></a>
          <ul class="dropdown-menu">
           <!--  {{-- @if (Auth::check()) --}}
              {{-- <li><a href="{{ route('user.profile') }}">User Profile</a></li> --}}
              {{-- <li role="separator" class="divider"></li>
              <li><a href="{{ route('user.logout') }}">Logout</a></li>
            @else
              <li><a href="{{ route('user.signup') }}">Signup</a></li>
              <li><a href="{{ route('user.signin') }}">Signin</a></li>
            @endif --}} -->
            <?php if(Auth::user()->role == 'Customer'): ?>
            <li><a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a></li>  
                <?php else: ?>
                    <li><a class="dropdown-item" href="{{ route('employee.profile') }}">Profile</a></li>
                <?php endif; ?>
                    <li role="separator" class="divider"></li>
                    <li><a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a></li>
            </li>
        @endguest
    </ul>
    </div>
    </ul>
    </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>