<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="api-token" content="{{-- auth()->user()->api_token --}}" />
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm dark-mode">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            @yield('navbar')
        </nav>
        <!-- Navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-info elevaprimarytion-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">

                <span class="brand-text font-weight-dark"> Natural Fitness Gym </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                @yield('sidebar')
                <!-- /.sidebar -->
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @yield('footer')
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @yield('scripts')
    @yield('pageScripts')
</body>

</html>