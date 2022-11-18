<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>

    @stack('up-style')
    @include('includes.style')
    @stack('down-style')


</head>
<style>
    .content-wrapper {
        background-image: url({{ asset('bg-dashboard.jpeg') }});
        background-repeat: no-repeat;
        background-size: cover;
    }
    /* .content-header h1 {
        color: #fff
    }
    .content-header .breadcrumb {
        color: #fff
    } */

</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->

        @include('includes.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    {{-- @include('sweetalert::alert') --}}
    @stack('up-script')
    @include('includes.script')
    @stack('down-script')
</body>

</html>
