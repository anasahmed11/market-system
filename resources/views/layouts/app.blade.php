<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Ahmed Elnemr">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
        <title>ERP | @yield('title')</title>
        @yield('before_css')
        @include('layouts.subviews.css')
        @yield('after_css')

        <script src="https://browser.sentry-cdn.com/4.6.4/bundle.min.js" crossorigin="anonymous"></script>
        <script>Sentry.init({ dsn: 'https://598c2e6499f94912b90b555c002bb5bd@sentry.io/1421218' });</script>
    </head>

    <body class="fix-header card-no-border fix-sidebar">
    <div id="wait" style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;"><img src='demo_wait.gif' width="64" height="64" /><br>Loading..</div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Admin Pro</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <a class="navbar-brand" href="{{ route('index') }}">
                <b>
                    LOGO
                </b>
            </a>
            <button class="navbar-toggler"
                    type="button" data-toggle="collapse"
                    data-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="main-nav">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto" >
                    <!-- This is  -->

                    <li class="nav-item dropdown ">
                        <a class="dropdown-toggle d-inline-block"
                           data-toggle="dropdown"
                           href="#"
                           style="height: 100%; line-height: 35px">
                            فاتورة بيع
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a class="nav-link btn " href="{{ route('invoices.create', 'selling-1') }}">
                                    قطاعي
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link btn" href="{{ route('invoices.create', 'selling-2') }}">
                                    جملة
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link btn" href="{{ route('invoices.index', 'selling-1') }}">
                                    كل الفواتير
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="dropdown-toggle d-inline-block"
                           data-toggle="dropdown"
                           href="#"
                           style="height: 100%; line-height: 35px">
                            فاتورة شراء
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a class="nav-link btn" href="{{ route('invoices.create', 'buying-1') }}">
                                    <i class="ti-user" ></i> فاتورة جديدة
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link btn" href="{{ route('invoices.index', 'buying-1') }}">
                                    كل الفواتير
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle d-inline-block"
                           data-toggle="dropdown"
                           href="#"
                           style="height: 100%; line-height: 35px">
                            المخزن
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a class="nav-link btn" href="{{ route('products.index') }}">
                                    <i class="ti-package"></i>المنتجات
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link btn" href="{{ route('categories.index') }}">
                                    <i class="ti-import"></i>الاصناف
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link btn" href="{{ route('report.storeState') }}">
                                    حالة المخزن
                                </a>
                            </li>
                            <li class="">
                                <a class="nav-link btn " href="{{ route('report.outOfStock') }}">
                                    النواقص
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            <i class="ti-face-smile"></i>العملاء
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('suppliers.index') }}">
                            <i class="ti-import"></i>الموردين
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="ti-user"></i>المستخدمين
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('branches.index') }}">
                            <i class="ti-home"></i>الفروع
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shifts.index') }}">
                            <i class="ti-time"></i>الورديات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.index') }}">
                            <i class="ti-face-smile"></i>الموظفين
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expenses.index') }}">
                            <i class="ti-money"></i>المصروفات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('expensesType.index') }}">
                            <i class="ti-money"></i> نوع المصروفات
                        </a>
                    </li>
                </ul>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <ul class="navbar-nav my-lg-0">
                    {{--<!-- ============================================================== -->--}}
                    {{--<!-- Profile -->--}}
                    {{--<!-- ============================================================== -->--}}
                    {{--<li class="nav-item dropdown">--}}
                        {{--<a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ Request::root() }}/backend/assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right animated flipInY">--}}
                            {{--<ul class="dropdown-user">--}}
                                {{--<li>--}}
                                    {{--<div class="dw-user-box">--}}
                                        {{--<div class="u-img"><img src="{{ Request::root() }}/backend/assets/images/users/1.jpg" alt="user"></div>--}}
                                        {{--<div class="u-text">--}}
                                            {{--<h4>Steave Jobs</h4>--}}
                                            {{--<p class="text-muted">varun@gmail.com</p><a href="pages-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#"><i class="ti-user"></i> My Profile</a></li>--}}
                                {{--<li><a href="#"><i class="ti-wallet"></i> My Balance</a></li>--}}
                                {{--<li><a href="#"><i class="ti-email"></i> Inbox</a></li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#"><i class="ti-settings"></i> Account Setting</a></li>--}}
                                {{--<li role="separator" class="divider"></li>--}}
                                {{--<li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </nav>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header-tabs">
                                <h3 class="text-center m-t-10">@yield('pageTitle')</h3>
                                <hr style="width: 80%">
                            </div>
                            <div class="card-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2019 GitSolve
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    @yield('before_js')
    @include('layouts.subviews.js')
    @yield('after_js')

    </body>
</html>
