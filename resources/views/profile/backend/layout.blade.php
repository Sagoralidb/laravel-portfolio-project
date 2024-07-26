<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title','Dashboard Admin')</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('backend-assets/css/styles.css') }}" rel="stylesheet" /> 
        <link href="{{ asset('common-assets/select2.min.css') }}" rel="stylesheet" /> 

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    
        <!-- Bootstrap CSS (optional, for styling) -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        
        <link href="{{asset('common-assets/select2.min.css')}}" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            
    

        <link rel="stylesheet" href="{{asset('common-assets/summernote/summernote-bs4.min.css')}}">
        <link rel="stylesheet" href="{{asset('common-assets/dropzone/dropzone.css')}}">
        <link rel="stylesheet" href="{{asset('common-assets/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend-assets/css/toastr.min.css')}}">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        {{-- <link rel="stylesheet" href="{{asset('backend-assets/plugins/select2/css/select2.min.css')}}"> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('cutomCss')
    </head>
    
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="javascript:void(0)">{{ auth('admin')->user()->name }}</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
               
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('list.admin')}}">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#!" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="{{route('main.dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                main
                            </a>
                            <a class="nav-link" href="{{route('categories.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-note-sticky"></i></div>
                                Category
                            </a>
                           
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>Services
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="{{route('create.services')}}">Create</a>
                                        <a class="nav-link" href="{{route('list.services')}}">List</a>
                                    </nav>
                                </div>
                              
                            <a class="nav-link" href="{{route('list.portfolio')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-images"></i></div>
                                Portfolio
                            </a>
                            <a class="nav-link" href="{{route('rating.list')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-star"></i></div>
                                Ratings
                            </a>
                            <a class="nav-link" href="{{route('list.user')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                               Users
                            </a>
                            <a class="nav-link" href="{{route('order.list')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice"></i></div>
                              Orders
                            </a>
                            <a class="nav-link" href="{{route('showPaymentList.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-dollar-sign text-success"></i></div>
                              Payment
                            </a>
                            <a class="nav-link" href="{{route('visitor.info')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-users-line"></i></div>
                              Visitors
                            </a>
                            {{-- <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                                Contact
                            </a> --}}
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                         Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; sagoralibd 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend-assets/js/scripts.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend-assets/assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('backend-assets/assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('backend-assets/js/datatables-simple-demo.js')}}"></script>
        <script src="{{asset('common-assets/dropzone/dropzone.js')}}"></script>
        <script src="{{asset('common-assets/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('backend-assets/js/toastr.min.js')}}"></script>

        <script src="{{asset('backend-assets/plugins/select2/js/select2.min.js')}}"></script>
           <!-- jQuery -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
    <!-- Initialize Summernote -->
        <script>
            $(document).ready(function() {
                $('#description').summernote({
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                  // set focus to editable area after initializing summernote
                });
            });
        </script>
         <script>
            $(document).ready(function() {
                $('#short_description').summernote({
                    height: 300,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: true                  // set focus to editable area after initializing summernote
                });
            });
        </script>
          
       @yield('scripts')
       
    </body>
</html>
