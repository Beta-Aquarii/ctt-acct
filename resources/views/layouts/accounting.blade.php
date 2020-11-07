<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lemon' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Berkshire Swash' rel='stylesheet'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-darkness/jquery-ui.css"></link>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/br.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <!-- Styles -->
    
</head>
<body>
    
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header a-navbar">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand brand-1" href="{{ url('/accounting') }}">
                    {{ config('app.name', 'Cebu Trip Tours') }}
                        <span class="brand-level">
                            Accounting
                        </span>
                   
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="a-navbar dropdown">
                        <a href="#" class="dropdown-toggle white text-bold nav-hover" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                            <i class="fa fa-btn fa-pagelines fa-navbar"></i> SOA
                        </a>

                        <ul class="dropdown-menu black-dropdown">
                            <li><a class="white text-bold nav-hover" href="{{url('accounting/statement-of-account')}}"><i class="fa fa-btn fa-spinner fa-navbar"></i> Pending</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href="{{url('accounting/statement-of-account/verified')}}"><i class="fa fa-btn fa-check-circle fa-navbar"></i> Verified</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href="{{url('accounting/sales-report')}}"><i class="fa fa-btn fa-file-text fa-navbar"></i> Sales Report</a></li>
                        </ul>
                    </li>
                    <!--<li class="a-navbar"><a class="white text-bold nav-hover" href="{{url('accounting/statement-of-account')}}"><i class="fa fa-btn fa-folder-open fa-navbar"></i> Sales Invoice</a></li>-->
                    <!--<li class="a-navbar dropdown">
                        <a href="#" class="dropdown-toggle text-bold white nav-hover" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-btn fa-file-text-o fa-navbar"></i> Sales Invoice <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('reservation/salesinvoice')}}" class="text-bold nav-hover"><i class="fa fa-btn fa-list"></i> Records</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('reservation/add/salesinvoice')}}" class="text-bold nav-hover"><i class="fa fa-btn fa-plus fa-navbar orange"></i> Add SI</a></a></li>
                            <li role="separator" class="divider"></li>
                        </ul>
                    </li>-->
                    <li class="a-navbar dropdown">
                        <a href="#" class="dropdown-toggle white text-bold nav-hover" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                           <i class="fa fa-btn fa-book fa-navbar"></i> Reports
                        </a>

                        <ul class="dropdown-menu black-dropdown">
                            <li><a class="white text-bold nav-hover" href="#"><i class="fa fa-btn fa-signing fa-navbar"></i> Collection</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href=""><i class="fa fa-btn fa-file-text fa-navbar"></i> Income Statement</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href=""><i class="fa fa-btn fa-balance-scale fa-navbar"></i> Balance Sheet</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href="#"><i class="fa fa-btn fa-handshake-o fa-navbar"></i> Account Receivable</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href="#"><i class="fa fa-btn fa-hourglass-2 fa-navbar"></i> Aging of Account Receivable</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href="#"><i class="fa fa-btn fa-clock-o fa-navbar"></i> Account Payable Due</a></li>
                        </ul>
                    </li>
                    <li class="a-navbar dropdown">
                        <a href="#" class="dropdown-toggle white text-bold nav-hover" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                           <i class="fa fa-btn fa-address-book-o fa-navbar"></i> Profiles
                        </a>

                        <ul class="dropdown-menu black-dropdown">
                            <li><a class="white text-bold nav-hover" href="{{url('accounting/tours')}}"><i class="fa fa-btn fa-leaf fa-navbar"></i> Tours</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a class="white text-bold nav-hover" href="{{url('accounting/agents')}}"><i class="fa fa-btn fa-user-secret fa-navbar"></i> Agents</a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown">
                           
                    </li>
                    <!--<li class="a-navbar"><a class="white text-bold" href="#"><i class="fa fa-btn fa-desktop fa-navbar"></i> Activity</a></li>-->
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle white text-bold nav-hover" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                <i class="fa fa-user-circle fa-navbar blue"></i>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu black-dropdown">
                                <li class="text a-navbar"><a href="#" class="text-bold si-options white"> <i class="fa fa-gears"></i> Change Password</a></li>
                                <li role="separator" class="divider"></li>
                                <li class="text a-navbar">
                                    <a href="{{ route('logout') }}" class="text-bold si-options white"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="container content-div">
        @yield('content')
    </div>

     @yield('js')
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('js/tinyplug.js') }}"></script>
    <script src="{{ asset('js/br.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

</body>
</html>
