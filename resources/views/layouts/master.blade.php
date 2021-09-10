<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GUSTOV</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="{{ asset('frontend') }}/dist/css/styles.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
  @yield('css_sale')
  @yield('css_report')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <div id="layoutSidenav">
                    <div id="layoutSidenav_nav">
                        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                            <div class="sb-sidenav-menu">
                                <div class="nav">
                                    <h5 class="text-center"><img alt="" src="{{ asset('frontend') }}/dist/assets/img/gustov.png" style="border: 5px solid; color: black; border-radius: 20px;" width="100px" height="100px"/> "GUSTOV"</h5>
                                    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                                        <ul class="navbar-nav ml-auto">
                                            <li class="nav-item dropdown user-menu">
                                                <ul class="navbar-nav ml-auto ml-md-0">
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                                                        @auth
                                                            {{ Auth::user()->name }}
                                                        @endauth
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="sb-sidenav-menu-heading">Stock</div>
                                    <a class="nav-link" href="{{ url('menus') }}">
                                        <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i> Menus</div>
                                    </a>
                                    <a class="nav-link" href="{{ url('sales') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i> Sales</div>
                                    </a>
                                    <a class="nav-link" href="#">
                                        <div class="sb-nav-link-icon">Menu User</div>
                                    </a>
                                    <a class="nav-link" href="{{ url('users') }}">
                                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i> Users</div>
                                    </a>
                                    <div class="sb-sidenav-menu-heading">Reports</div>
                                    <a class="nav-link" href="{{ url('reports') }}">
                                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i> Day Reports</div>
                                    </a>
                                </div>
                            </div>
                        </nav>
                    </div>
                    <div id="layoutSidenav_content">
                        <main>
                        <div class="container-fluid">
                            <div class="card mb-24"> 
                            @yield('content')
                            @yield('btn_imprimir')
                            </div>
                        </div>
                        </main>
                    </div>
                </div>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure to log out?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">Otherwise you can cancel.</div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel</button>

                <a class="btn btn-primary" href="#"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout?') }}
                </a>
                <form id="logout-form" action="{{ url('login') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend') }}/dist/js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    @yield('js_user')
    @yield('js_sale')
    @yield('js_report')
</body>
</html>
