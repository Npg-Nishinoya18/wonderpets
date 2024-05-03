<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
    #logo {
      display: inline-block;
      margin: 15px; /* margin: 20px was off */
      float: left;
      height: 60px;
      width: auto; /* correct proportions to specified height */
      border-radius: 50%; /* makes it a circle */
    }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ URL::asset('css/searchstyle.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'WONDERPETS PET CLINIC') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/fontawesome.min.js" integrity="sha512-PoFg70xtc+rAkD9xsjaZwIMkhkgbl1TkoaRrgucfsct7SVy9KvTj5LtECit+ZjQ3ts+7xWzgfHOGzdolfWEgrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home') }}">
                    WONDERPETS PET CLINIC
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                            <a class="nav-link" href="{{ route('getCustomers') }}"><i class="fas fa-user-alt"></i> Customer</a>
                        

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('getPets') }}"><i class="fas fa-paw"></i> Pet</a>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('getEmployees') }}"><i class="fas fa-user-tie"></i> Employee</a>
                        </li> 

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('grooming.index') }}"><i class="fa fa-scissors grey-text"></i> Grooming Services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consultation.index') }}"><i class="fa fa-stethoscope"></i> Consultation</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('groomingtransaction.index') }}"><i class="fa fa-credit-card-alt"></i> Grooming Transaction</a>
                        </li>
                    </li>


                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('user.signin'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.signin') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('user.signup'))
                                <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Register
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('user.signup') }}">Customer Registration</a>  
                                  <a class="dropdown-item" href="{{ route('user.signup') }}">Employee Registration</a>
                                </div>
                            </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img id="logo" src="{{ asset('/images/user/'.Auth::user()->user_img) }}">
                                   
                                    <!-- {{ Auth::user()->name }} -->
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <?php if(Auth::user()->role == 'Customer'): ?>
                                  <a class="dropdown-item" href="{{ route('customer.profile') }}">Profile</a>  
                                <?php else: ?>
                                  <a class="dropdown-item" href="{{ route('employee.profile') }}">Profile</a>
                                <?php endif; ?>

                                <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
