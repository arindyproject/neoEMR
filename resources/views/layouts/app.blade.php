<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="">

    <title>{{ \App\Models\Config::get()['name'] }}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}">



    @include('layouts.styles')

    <!-- ----------------------add style------------------ -->
    @stack('styles')
    <!-- ----------------------add style------------------ -->
</head>

<body class="
            sidebar-mini layout-fixed sidebar-collapse
            {{ \App\Models\Config::get()['dark_mode'] ? 'dark-mode' : '' }}
            {{ \App\Models\Config::get()['navbar_fixed'] ? 'layout-navbar-fixed' : '' }}
            ">
    <div class="wrapper">

   

        <!-- Navbar -->
        <nav class="
                    main-header 
                    navbar 
                    navbar-expand 
                    navbar-{{\App\Models\Config::get()['navbar_variants']}} 
                    {{ \App\Models\Config::get()['dark_mode'] ? 'navbar-dark' : 'navbar-light' }}
                    ">
            <!-- Left navbar links -->
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- @include('layouts.menus') -->
                @stack('header_menus')
            </ul>
            <!-- Left navbar links -->



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" action="{{Route('patient.index')}}">
                            <div class="input-group input-group-sm">
                                <input name="q" class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Navbar Search -->


                <!-- ----------------------add rightnavbar------------------ -->
                @if (Auth::user()->level == '1')
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">
                            {{ count($list_user_non_akktif ?? '')}}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">{{ count($list_user_non_akktif ?? '')}}
                            Notifications</span>

                        <div class="dropdown-divider"></div>
                        <a href="{{route('admin.list_non_aktif')}}" class="dropdown-item">
                            <i class="fas fa-users-slash"></i>
                            {{ count($list_user_non_akktif ?? '')}} User Non Aktif
                        </a>

                    </div>
                </li>
                @endif

                <!-- ----------------------add rightnavbar------------------ -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"></i>
                        {{ Auth::user()->name }}</a>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <a href="{{route('profile',Auth::user()->id )}}" class="dropdown-item dropdown-footer"><i
                                class="fas fa-user-alt"></i>
                            {{ Auth::user()->name }}</a>


                        <a href="{{route('profile.edit',Auth::user()->id )}}" class="dropdown-item dropdown-footer"><i
                                class="fas fa-user-cog"></i>
                            Setting </a>
                        
                        <a href="{{ route('profile.list') }}" class="dropdown-item dropdown-footer"><i class="fas fa-users"></i>
                                User List </a>

                        <a href="{{ route('post_test.index') }}" class="dropdown-item dropdown-footer"><i class="far fa-newspaper"></i>
                                Post Test </a>

                        <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            LOGOUT</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!-- Right navbar links -->
        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-{{ \App\Models\Config::get()['dark_mode'] ? 'dark' : 'light' }}-{{\App\Models\Config::get()['navbar_variants']}}  elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('images/icon') .'/'. \App\Models\Config::get()['icon_mini'] }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><b>{{ \App\Models\Config::get()['name'] }}</b></span>
            </a>
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @include('layouts.side_menus')
                    </ul>
                </nav>
                <!-- Sidebar Menu -->

            </div>
            <!-- Sidebar -->
        </aside>
        <!-- Main Sidebar Container -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <!-- $$$$$$$$$$$-->
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!-- $$$$$$$$$$$-->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- ----------------------add content------------------ -->
                    @yield('content')
                    <!-- ----------------------add content------------------ -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
        </div>
        <!-- Content Wrapper. Contains page content -->



        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('layouts.scripts')


    <!-- ----------------------add script------------------ -->
    @stack('scripts')
    <!-- ----------------------add script------------------ -->


    @if (\App\Models\Config::get()['footer'] == "1")
    <footer class="main-footer">
        <strong>neoEMR by ArindyProject - Copyright © 2023
            <a href="https://github.com/arindyproject" target="_blank" class="btn"> <i class="fab fa-github"></i> GitHub</a>
            <a href="https://www.youtube.com/@arindyproject" target="_blank" class="btn"> <i class="fab fa-youtube"></i> Youtube</a>
            <a href="https://www.instagram.com/arindyproject" target="_blank" class="btn"> <i class="fab fa-instagram"></i> arindyproject</a>
            <a href="https://www.instagram.com/devarindy" target="_blank" class="btn"> <i class="fab fa-instagram"></i> devarindy</a>
            <a href="https://laravel.com/" target="_blank" class="btn"> <i class="fab fa-laravel"></i> Laravel-10</a>
            <a href="https://adminlte.io/themes/v3/index3.html" target="_blank" class="btn">Template : AdminLTE-3</a>
            </strong>
        <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
        </div>
    </footer>   
    @endif
    


    

    <script type="text/javascript">

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
     
        $(function () {
            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure ?',
                    text: "apakah anda yakin menghapus item ini?? " + id,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.delete-submit-form').submit();
                    }
                })
            });

            

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });

            @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ session("error") }}'
            })
            @endif

            @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session("success") }}'
            })
            @endif

            @if(session('status'))
            Toast.fire({
                icon: 'success',
                title: '{{ session("status") }}'
            })
            @endif

            @if(session('info'))
            Toast.fire({
                icon: 'info',
                title: '{{ session("info") }}'
            })
            @endif

            @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: '{{ session("warning") }}'
            })
            @endif


        });

    </script>
</body>






</html>
