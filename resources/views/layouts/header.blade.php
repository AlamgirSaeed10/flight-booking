<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <!-- Fonts -->


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
</head>
 <body data-sidebar="dark">
    @include('sweetalert::alert')
    <div id="layout-wrapper">
        <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{route('dashboard')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo.png')}}" alt="Zistravels logo" height="10">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo.png')}}" alt="Zistravels logo" height="40">
                                </span>
                            </a>

                            <a href="{{route('dashboard')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo.png')}}" alt="Zistravels logo" height="10">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo.png')}}" alt="Zistravels logo" height="40">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/'.\Illuminate\Support\Facades\Auth::user()->image)}}"
                                    alt="Header Avatar {{Auth::user()->name}}">
                                    {{Auth::user()->name}}

                                <span class="d-none d-xl-inline-block ms-1" key="t-henry"> </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span key="t-profile">Profile</span></a>
{{--                                <a class="dropdown-item d-block" href="#"><i class="bx bx-wrench font-size-16 align-middle me-1"></i> <span key="t-settings">Settings</span></a>--}}
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="vertical-menu">
                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="{{url('dashboard')}}" class="waves-effect">
                                    <i class="bx bxs-dashboard"></i><span key="t-dashboards">Dashboard</span>
                                </a>
                            </li>
                            @if(Auth::user()->Role === "Super Admin")
                            <li>
                                <a href="{{url('pending-tasks')}}" class="waves-effect">
                                    <i class="mdi mdi-format-list-checks"></i><span key="t-dashboards">Pending Tasks</span>
                                </a>
                            </li>
                            @endif

                             <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-book"></i><span key="t-dashboards">Client Bookings</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('booking-flight')}}" key="t-default">Add</a></li>
                                    <li><a href="{{url('pending-tickets')}}" key="t-saas">Pending</a></li>
                                    <li><a href="{{url('issued-tickets')}}" key="t-crypto">Issued</a></li>
                                    <li><a href="{{url('cancelled-booking')}}" key="t-blog">Cancelled</a></li>
                                    <li><a href="{{url('hold-bookings')}}" key="t-blog">Hold Bookings</a></li>
                                    <li><a href="{{url('search-data')}}" key="t-blog">Search</a></li>
                                </ul>
                            </li>



                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="mdi mdi-shield-account-outline"></i><span key="t-dashboards">Administration</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{url('reports')}}" key="t-blog">Reports</a></li>

                                    <li><a href="javascript: void(0);" class="has-arrow waves-effect"><span key="t-dashboards">Agent Setting</span></a>
                                        <ul class="sub-menu" aria-expanded="false" style="">
                                            <li><a href="{{route('duplicate-ticket')}}">Duplicate Ticket</a></li>
                                            @if(Auth::user()->Role === "Super Admin")
                                            <li><a href="{{route('agent-form')}}">Add Agent</a></li>
                                            <li><a href="{{route('agents-details')}}">View Agent</a></li>
                                        </ul>
                                    </li>

                                </ul>
                                </li>
                                @endif

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                       <main class="py-4">
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/dashboard-blog.init.js')}}"></script>
        <script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
        <script src="{{asset('assets/js/pages/form-repeater.int.js')}}"></script>
        <script src="{{asset('assets/js/app.js')}}"></script>

</body>
</html>
