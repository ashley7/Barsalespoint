<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
 
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
 
  


   <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.dataTables.min.css') }}"> 

  
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                   {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                       
                        <!-- Authentication Links -->

                        @guest
                            <!-- <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li> -->
                            <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                        @else
                          <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('sales.create')}}">Sales</a></li>
                          <!-- <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('cheque.index')}}">cheque</a></li> -->
                          <!-- <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('bank_deposite.index')}}">Bank Deposit</a></li> -->
                          <!-- <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('bank_deposite.create')}}">Add Bank Deposit</a></li> -->
                          <!-- <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('bank.index')}}">Bank</a></li> -->
                          <!-- <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('bank.create')}}">Add Bank</a></li> -->
                          
                          <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('expense.index')}}">Expenses</a></li>
                          <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('account.index')}}">Accounts</a></li>

                          <li><a class="nav-link" style="text-transform: uppercase;" href="{{route('user.index')}}">Users</a></li>

                          <li>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
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

      <script type="text/javascript">
        var el = document.querySelector('input.number');
        el.addEventListener('keyup', function (event) {
          if (event.which >= 37 && event.which <= 40) return;
          this.value = this.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        });
     </script>
     @stack('scripts')

  
</body>
</html>
