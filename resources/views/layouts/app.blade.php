
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Payformat') }}</title>

    <!-- Core Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/plugins/notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset('js/plugins/notifications/bootbox.min.js') }}"></script>

    {{-- Icons --}}    
    <link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Global stylesheets -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    {{-- scripts needed for specific pages --}}
    @stack('scripts')

</head>
<body>
    <div id="app">

        <!-- Modals -->

        <!-- payment models -->
        <div id="make_payment" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Make Payment</h5>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <div class="modal-body mb-2">
                        <div class="row d-flex justify-content-center mt-3">
                            <div class="col">
                                <label for="payment_search" class="font-weight-semibold">Search Client:</label>
                                <input class="form-control" type="search" name="search" id="payment_search" placeholder="Search by ID, surname, name or phone number">
                                <!-- <span class="form-text badge badge-info"></span> -->
                            </div>
                        </div>
                        <div class="row mt-2 payment-list">
                            <div class="col" id="client_list">
                                <!-- content here -->
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link dismiss-modal" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary d-none" id="pay_btn">Pay <i class="icon-paperplane ml-1"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- payment info modal -->
        <div id="payment_view" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Client Payment Info</h5>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <div class="modal-body mb-2">
                        <!-- // -->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary d-none" id="pay_btn">Mark Error <i class="icon-warning ml-1"></i></button>
                        <button type="button" class="btn btn-link dismiss-modal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main navbar -->
        <div class="navbar navbar-expand-lg navbar-dark navbar-static">
            <div class="d-flex flex-1 d-lg-none">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                    <i class="icon-paragraph-justify3"></i>
                </button>
                <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                    <i class="icon-transmission"></i>
                </button>
            </div>

            {{-- Logo --}}
            <div class="text-center text-lg-left d-flex align-items-center">
                <a href="/home" class="d-inline-block text-uppercase text-white" style="font-size: 20px">
                    <span class="d-none d-sm-block" alt="">{{ config('app.name') }}</span>
                </a>
            </div>

            <div class="collapse navbar-collapse order-2 order-lg-1" id="navbar-mobile">

                <!-- new user request alerts -->
                <ul class="navbar-nav">
                    <?php
                    // $request = new Request();
                    // $requests = $request->getRequests('new');
                    ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="navbar-nav-link" data-toggle="dropdown">
                            <i class="icon-git-compare"></i>
                            <span class="d-lg-none ml-3">New Customer Request</span>
                            <span class="badge badge-warning badge-pill ml-auto ml-lg-0">2</span>
                        </a>

                        <div class="dropdown-menu dropdown-content wmin-lg-350">
                            <div class="dropdown-content-header border-bottom">
                                <span class="font-weight-semibold">New Customer Request</span>
                                <a href="#" class="text-body refresh"><i class="icon-sync"></i></a>
                            </div>

                            <div class="dropdown-content-body dropdown-scrollable pl-0 pr-0">
                                <ul class="media-list">
                                    {{-- <?php if ($requests) {
                                        foreach ($requests as $req) { ?>

                                            <li class="media hover pl-3 pr-3 p-2">
                                                <div class="mr-3">
                                                    <a href="user_profile?id=<?= $req->user_id ?>" class="btn bg-transparent border-primary text-primary rounded-pill border-2 btn-icon"><img src="{{ asset('images/demo/users/face1.jpg') }}" width="40" height="40" class="rounded-circle" alt=""></a>
                                                </div>

                                                <div class="media-body">
                                                    <a href="user_profile?id=<?= $req->user_id ?>" class="text-capitalize d-block"><?= $req->name ?></a>
                                                    <?= $req->readMore($req->msg) ?>
                                                    <div class="text-muted font-size-sm"><?= format_time($req->time) ?></div>
                                                </div>
                                            </li>

                                        <?php }
                                    } else { ?>
                                        <li>No New Customer Request</li>
                                    <?php } ?> --}}
                                </ul>
                            </div>

                            <div class="dropdown-content-footer bg-light">
                                <a href="order_request" class="text-body mr-auto">All Requests</a>
                                <div>
                                    <a href="#" class="text-body" data-popup="tooltip" title="Mark all as read"><i class="icon-radio-unchecked radio-check"></i></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- online status -->
                <span class="online-status badge badge-success my-3 my-lg-0 ml-lg-3">Online</span>

                <!-- Make payment -->
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a href="#" class="navbar-nav-link" title="Make payment" data-toggle="modal" data-target="#make_payment">
                            <i class="icon-credit-card" style="font-size: 24px;"></i>
                            <span class="d-lg-none ml-3">Messages</span>
                        </a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav flex-row order-1 order-lg-2 flex-1 flex-lg-0 justify-content-end align-items-center">

                <!-- new messages -->
                <li class="nav-item nav-item-dropdown-lg dropdown">
                    <a href="#" class="navbar-nav-link navbar-nav-link-toggler" data-toggle="dropdown">
                        <i class="icon-bubbles4"></i>
                        <span class="badge badge-warning badge-pill ml-auto ml-lg-0">2</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-350">
                        <div class="dropdown-content-header">
                            <span class="font-weight-semibold">Messages</span>
                            <a href="#" class="text-body"><i class="icon-compose"></i></a>
                        </div>

                        <div class="dropdown-content-body dropdown-scrollable">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="{{ asset('images/demo/users/face10.jpg') }}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">James Alexander</span>
                                                <span class="text-muted float-right font-size-sm">04:58</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3 position-relative">
                                        <img src="{{ asset('images/demo/users/face3.jpg') }}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>

                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Margo Baker</span>
                                                <span class="text-muted float-right font-size-sm">12:16</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">That was something he was unable to do because...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="{{ asset('images/demo/users/face24.jpg') }}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Jeremy Victorino</span>
                                                <span class="text-muted float-right font-size-sm">22:48</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">But that would be extremely strained and suspicious...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="{{ asset('images/demo/users/face4.jpg') }}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Beatrix Diaz</span>
                                                <span class="text-muted float-right font-size-sm">Tue</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="mr-3">
                                        <img src="{{ asset('images/demo/users/face25.jpg') }}" width="36" height="36" class="rounded-circle" alt="">
                                    </div>
                                    <div class="media-body">
                                        <div class="media-title">
                                            <a href="#">
                                                <span class="font-weight-semibold">Richard Vango</span>
                                                <span class="text-muted float-right font-size-sm">Mon</span>
                                            </a>
                                        </div>

                                        <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="dropdown-content-footer justify-content-center p-0">
                            <a href="#" class="btn btn-light btn-block border-0 rounded-top-0" data-popup="tooltip" title="Load more"><i class="icon-menu7"></i></a>
                        </div>
                    </div>
                </li>

                <!-- Menu options -->
                <li class="nav-item nav-item-dropdown-lg dropdown dropdown-user h-100">
                    <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle d-inline-flex align-items-center h-100" data-toggle="dropdown">
                        <img src="<?= Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : asset('images/demo/users/face1.jpg') ?>" class="rounded-pill" height="34" alt="">
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= route('profile') ?>" class="dropdown-item">
                            <i class="icon-user-plus"></i> My profile</a>
                        <a href="#" class="dropdown-item">
                            <i class="icon-coins"></i> My balance</a>
                        <a href="#" class="dropdown-item">
                            <i class="icon-comment-discussion"></i> Messages
                            <span class="badge badge-primary badge-pill ml-auto">58</span></a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="icon-cog5"></i> Account settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="icon-switch2"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /main navbar -->

        <!-- Page content -->
        <main class="page-content pb-4">
            @include('layouts.sidebar')
            {{-- @yield('sidebar') --}}

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Inner content -->
                <div class="content-inner">

                    <!-- Page header -->
                    <div class="page-header page-header-light">
                        <div class="page-header-content header-elements-lg-inline">
                            <div class="page-title d-flex">
                                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">{{ $breadcrumb[0] }}</span> - {{ $breadcrumb[1] }}</h4>
                                <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                            </div>

                            <div class="header-elements d-none">
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-link btn-float text-body"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                    <a href="#" class="btn btn-link btn-float text-body"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                                    <a href="#" class="btn btn-link btn-float text-body"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                </div>
                            </div>
                        </div>

                        {{-- breadcrumb container --}}
                        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
                            {{-- breadcrumb --}}
                            <div class="d-flex">
                                <div class="breadcrumb">
                                    <?php for ($i=0; $i < count($breadcrumb); $i++) { 
                                        if ($i == 0) { ?>
                                            <a href="home" class="breadcrumb-item">
                                                <i class="icon-home2 mr-2"></i> {{ $breadcrumb[$i] }}</a>
                                        <?php } elseif ($i == count($breadcrumb)-1) { ?>
                                            <span class="breadcrumb-item active">{{ $breadcrumb[$i] }}</span>
                                        <?php } else { ?>
                                            <a href="#" class="breadcrumb-item">{{ $breadcrumb[$i] }}</a>
                                        <?php }
                                    } ?>
                                </div>

                                <a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
                            </div>

                            {{-- breadcrumb right side elements --}}
                            <div class="header-elements d-none">
                                <div class="breadcrumb justify-content-center">
                                    
                                    <a href="{{ route('connect') }}" class="breadcrumb-elements-item">
                                        <i class="icon-link mr-2"></i>
                                        Connect
                                    </a>

                                    <a href="#" class="breadcrumb-elements-item">
                                        <i class="icon-comment-discussion mr-2"></i>
                                        Support
                                    </a>

                                    <div class="breadcrumb-elements-item dropdown p-0">
                                        <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-gear mr-2"></i>
                                            Settings
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                                            <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                                            <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /page header -->

                    @yield('content')
                    
                </div>
                <!-- /inner content -->

            </div>
            <!-- /main content -->

        </main>

        <!-- Footer -->
        <div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 99;">
            <div class="text-center d-lg-none w-100">
                <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
                    <i class="icon-unfold mr-2"></i>
                    Footer
                </button>
            </div>

            <div class="navbar-collapse collapse" id="navbar-footer">
                <span class="navbar-text">
                    &copy; <?= date('Y'); ?>. <a href="#">{{ config('app.name', 'Payformat') }}</a> by <a href="#" target="_blank">Tosman</a>
                </span>

                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i class="icon-lifebuoy mr-2"></i> Support</a></li>
                    <li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i class="icon-file-text2 mr-2"></i> About us</a></li>
                    <li class="nav-item"><a href="#" class="navbar-nav-link font-weight-semibold"><span class="text-pink"><i class="icon-cart2 mr-2"></i> Sell</span></a></li>
                </ul>
            </div>
        </div>
        <!-- /footer -->

    </div>
</body>
</html>
