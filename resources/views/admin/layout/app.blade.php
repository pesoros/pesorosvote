<html>
    <head>
        <meta charset="utf-8" />
        <title>Pesoros. | Vote</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('adminassets/images/favicon.ico') }}">
    
        <!-- Bootstrap Css -->
        <link href="{{ asset('adminassets/css/bootstrap-dark.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    
        <!-- Icons Css -->
        <link href="{{ asset('adminassets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('adminassets/css/app-dark.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        @yield('style')    
    
    </head>

    <body data-layout="horizontal">

        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
    
        <!-- Begin page -->
        <div id="layout-wrapper">
    
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/logo-pesoros.png') }}" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/logo-pesoros.png') }}" alt="" height="30">
                                </span>
                            </a>
    
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/logo-pesoros.png') }}" alt="" height="30">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/logo-pesoros.png') }}" alt="" height="30">
                                </span>
                            </a>
                        </div>
    
                        <button type="button" class="btn btn-sm me-2 font-size-24 d-lg-none header-item waves-effect waves-light"
                            data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                            <i class="mdi mdi-menu"></i>
                        </button>
    
                    </div>
    
                    <div class="d-flex">
    
                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect">
                                <a href="{{ url('dashboard/logout') }}">
                                    <i class="mdi mdi-logout-variant"></i>
                                </a>
                            </button>
                        </div>
    
                    </div>
                </div>
    
                <!-- start page title -->
                @yield('pagetitle')
                <!-- end page title -->
    
            </header>
    
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
    
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                ©
                                <script>document.write(new Date().getFullYear())</script> Polling<span class="d-none d-sm-inline-block"> -
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Pesoros.</span>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->
    
        </div>
        <!-- END layout-wrapper -->
    
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
    
        <!-- JAVASCRIPT -->
        <script src="{{ asset('adminassets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('adminassets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('adminassets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('adminassets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('adminassets/libs/node-waves/waves.min.js') }}"></script>
    
        <!--Morris Chart-->
        <script src="{{ asset('adminassets/libs/morris.js/morris.min.js') }}"></script>
        <script src="{{ asset('adminassets/libs/raphael/raphael.min.js') }}"></script>
        
        @yield('scripts')
    
        <script src="{{ asset('adminassets/js/app.js') }}"></script>
    
    </body>
</html>