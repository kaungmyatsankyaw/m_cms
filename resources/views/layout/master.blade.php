<!DOCTYPE html>
<html>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<head>
    <title>@yield('title')</title>
    <link rel="Shortcut Icon" href="{{ asset('/image/mintheinkha_logo.ico') }}"/>
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/bower_components/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/bower_components/Ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/css/AdminLTE.min.css') }}">
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('/dist/css/skins/skin-black-light.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{asset('bower_components/morris.js/morris.css')}}">
    <link rel="stylesheet"
          href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">--}}

    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet"
          href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('/dist/js/chart.js') }}"></script>
    {{--<script src="{{ asset('js/monent.js') }}"></script>--}}
    {{--<script src="cdn.datatables.net/plug-ins/1.10.16/sorting/datetime-moment.js"></script>--}}
    {{--<script src="{{ asset('/js/date-monent.js') }}"></script>--}}
    {{--<script src="{{ asset('/js/type.js') }}"></script>--}}
    {{--<script src="{{ asset('/js/date-edu.js') }}"></script>--}}

</head>
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

</style>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <a href="{{ url('/') }}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

        </nav>
    </header>

    <aside class="main-sidebar">
        <section class="sidebar" style="height: auto;">
            <ul class="sidebar-menu " data-widget="tree" id="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="home">
                    <a href="{{ url('/') }}">
                        <i class="fa fa-dashboard"></i> <span>Astrologer</span>
                    </a>
                </li>
                <li class="stat">
                    <a href="{{ url('/status') }}">
                        <i class="fa fa-dashboard"></i> <span>Status</span>
                    </a>
                </li>
                <li class="operator">
                    <a href="{{ url('/operator') }}">
                        <i class="fa fa-dashboard"></i> <span>Operator</span>
                    </a>
                </li>
                <li class="oper_chat">
                    <a href="{{ url('/operator_chat') }}">
                        <i class="fa fa-dashboard"></i> <span>Operator Chat</span>
                    </a>
                </li>
                <li class="mpt">
                    <a href="{{ url('/mpt') }}">
                        <i class="fa fa-dashboard"></i> <span>MPT</span>
                    </a>
                </li>
                <li class="ooreedoo">
                    <a href="{{ url('/ooreedoo') }}">
                        <i class="fa fa-dashboard"></i> <span>Ooreedoo</span>
                    </a>
                </li>
                <li class="telenor">
                    <a href="{{ url('/telenor') }}">
                        <i class="fa fa-dashboard"></i> <span>Telenor</span>
                    </a>
                </li>
                <li class="count">
                    <a href="{{ url('/count') }}">
                        <i class="fa fa-dashboard"></i> <span>Count</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>

    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

</div>

@include('layout.footer')

<script type="text/javascript">
    $('document').ready(function () {
        $('#reservation').daterangepicker();
    });
</script>

<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>

<script>
    $(document).ready(function () {
        let page = window.location.pathname;
        console.log(page);
        if (page == '/status') {
            $('.stat').addClass('active');
        } else if (page == '/operator') {
            $('.operator').addClass('active');
        } else if(page=='/operator_chat'){
            $('.oper_chat').addClass('active');
        }else  if(page=='/mpt'){
            $('.mpt').addClass('active');
        }else if(page=='/ooreedoo'){
            $('.ooreedoo').addClass('active');
        }else if(page=='/telenor'){
            $('.telenor').addClass('active');
        }else if(page=='/count'){
            $('.count').addClass('active');
        }
        else {
            $('.home').addClass('active');
        }
    });
</script>

</body>
</html>