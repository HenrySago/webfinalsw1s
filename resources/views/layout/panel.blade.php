<!DOCTYPE html>

<html lang="en">
   

    <head>
        <meta charset="utf-8" />
        <title>Lector medidor</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/jqvmap/jqvmap/jqvmap.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/icheck/skins/all.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/typeahead/typeahead.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.css')}}" rel="stylesheet" type="text/css" /> 


        <link href="{{asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" />


        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{asset('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/layouts/layout/css/themes/light2.css')}}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{asset('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="{{asset('css/jquery.bxslider.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/star-rating-svg.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('css/file-upload.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="assets/global/css/theme.css">
        <!-- END THEME LAYOUT STYLES -->
         </head>
        @stack('links')
        <style>
            .form-control:focus {
                border-color: #3498DB;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
                border-width: 2px;
            }
            .js div#preloader {
              position: fixed;
              left: 0;
              top: 0;
              z-index: 999;
              width: 100%;
              height: 100%;
              overflow: visible;
              background: white url('https://icon-library.com/images/loading-gif-icon/loading-gif-icon-11.jpg') no-repeat center center;
            }
            .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > .username {
                color: #f6f6f6;
                font-weight: 700;
            }
            .page-header.navbar .top-menu .navbar-nav > li.dropdown-user > .dropdown-toggle > i {
                color: #ffffff;
            }
            .page-header.navbar .top-menu .navbar-nav > li.dropdown.open .dropdown-toggle {
                background-color: #4f646a;
            }
            ul.dropdown-menu {
                min-width: 146px !important;
               border-radius: 0px !important;
            }
            body::-webkit-scrollbar {
              width: 10px;
            }

            .menu-list::-webkit-scrollbar-track {
              box-shadow: inset 0 0 5px; 
              border-radius: 10px;
            }
             
            body::-webkit-scrollbar-thumb {
              border-radius: 3px;
              box-shadow: inset 0 0 6px rgba(0,0,0,.3);
              background-color: #4f646a;
              border: 1px solid white;
            }

            body::-webkit-scrollbar-thumb:hover {
              background: #4f646a;
            }
     
            @media only screen and (max-width: 300px) {
                #navciudad{
                    width: 100% !important;
                }        
                .page-header.navbar .top-menu .navbar-nav>li.dropdown {
                    margin: 0;
                    /* padding: 0 4px; */
                    height: 46px;
                    width: 100%;
                    display: inline-block;
                } 
                .page-header.navbar .top-menu .navbar-nav {
                    margin-right: 0;
                    width: 100%;
                }       
            } 
            @media only screen and (max-width: 200px) {
                #navciudad{
                    width: 100% !important;
                }        
                .page-header.navbar .top-menu .navbar-nav>li.dropdown {
                    margin: 0;
                    /* padding: 0 4px; */
                    height: 46px;
                    width: 100%;
                    display: inline-block;
                } 
                .page-header.navbar .top-menu .navbar-nav {
                    margin-right: 0;
                    width: 100%;
                }       
            } 
            @media only screen and (max-width: 180px) {
                #navciudad{
                    width: 100% !important;
                }        
                .page-header.navbar .top-menu .navbar-nav>li.dropdown {
                    margin: 0;
                    /* padding: 0 4px; */
                    height: 46px;
                    width: 100%;
                    display: inline-block;
                } 
                .page-header.navbar .top-menu .navbar-nav {
                    margin-right: 0;
                    width: 100%;
                }       
            } 
            .btn.plomo:not(.btn-outline) {
                color: #FFF;
                background-color: #4f646a;
                border: none;
            }
            .btn.plomo:not(.btn-outline).active, .btn.plomo:not(.btn-outline):active, .btn.plomo:not(.btn-outline):hover, .open>.btn.plomo:not(.btn-outline).dropdown-toggle {
                color: #FFF;
                background-color: #4f646a;
                border: none;
            }
            .btn.plomo:not(.btn-outline) {
                color: #FFF;
                background-color: #a19d9b;
                border: none;
            }
            .btn.plomo:not(.btn-outline).active, .btn.plomo:not(.btn-outline):active, .btn.plomo:not(.btn-outline):hover, .open>.btn.plomo:not(.btn-outline).dropdown-toggle {
                color: #FFF;
                background-color: #a19d9b;
                border: none;
            }
            .btn{
              border-radius: 15px !important;
            }
            .round{
              border-radius: 15px !important;
            }
            .orange{
              background-color: #4f646a !important;
              color: white;
            }
            .orange:hover{
              background-color: #4f646a !important;
              color: white;
            }
            .portlet.oranget, .portlet.box.oranget>.portlet-title, .portlet>.portlet-body.oranget {
                background-color: #4f646a;
                color: black;
                border: 1px solid #4f646a;
            }
            .colorwhite{
              color: white !important;
            }
            .portlet.plomot, .portlet.box.plomot>.portlet-title, .portlet>.portlet-body.plomot {
                background-color: #a19d9b;
                color: black;
                border: 1px solid #a19d9b;
            }
            .colorwhite{
              color: white !important;
            }
            .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a, .page-sidebar .page-sidebar-menu > li.active > a, .page-sidebar .page-sidebar-menu > li.active.open > a {
                background: #4f646a;
                border-top-color: transparent;
                color: #ffffff;
            }
            .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active > a:hover, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu > li.active.open > a:hover, .page-sidebar .page-sidebar-menu > li.active > a:hover, .page-sidebar .page-sidebar-menu > li.active.open > a:hover {
                background: #4f646a;
            }
            .btn.focus, .btn:focus, .btn:hover {
                color: #ffffff;
                text-decoration: none;
            }
            .page-sidebar.collapse {
                max-height: none!important;
                position: fixed;
            }
            .bg-hover-white:hover, .bg-white {
                background: #9ea3a5 !important;
                padding: 5px;
            }

            .border {
                border: 1px solid #9ea3a5 !important;
                color: white;
            }
        </style>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="{{url('dashboard')}}">
                        <img src="{{asset('assets/layouts/layout/img/logo.png')}}" alt="logo" class="logo-default" style="width: 162px;object-fit: contain;margin: 0;" /> </a>
                    <!-- <div class="menu-toggler sidebar-toggler"> </div>-->
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                @if(isset(auth()->user()->id))
                                <img alt="" class="img-circle" src="{{ auth()->user()->perfil }}" />
                                <span class="username username-hide-on-mobile"> {{ auth()->user()->name }} </span>
                                <i class="fa fa-angle-down"></i>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> Mi Perfil </a>
                                </li>
                                <li>
                                    <a onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                        <i class="icon-key"></i> Cerrar sesión </a>
                                </li>
                                <li>
                                <a onclick="myFunction();"> <i class="icon-key"></i> Dark Mode </a>
                                </li>
                            </ul>
                           
                        </li>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div id="menu" class="page-sidebar navbar-collapse collapse">
                  
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

                        <li class="heading">
                            <h3 class="uppercase">PANEL ADMINISTRATIVO</h3>
                        </li>
                        <li class="nav-item" id="itemDashboard">
                            <a href="{{url('dashboard')}}" class="nav-link ">
                                <i class="fab fa-renren"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item " id="navAdministracion">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-laptop"></i>
                                <span class="title">Administración</span>
                                <span class="arrow"></span>
                            </a>
                             <ul class="sub-menu">
                                <li class="nav-item " id="itemCiudad">
                                    <a href="{{url('ciudad')}}" class="nav-link ">
                                        <i class="fa fa-flag"></i>
                                        <span class="title">Zona</span>
                                    </a>
                                </li>
                                <li class="nav-item " id="itemGestion">
                                    <a href="{{url('gestion')}}" class="nav-link ">
                                        <i class="fa fa-address-book"></i>
                                        <span class="title">Gestión</span>
                                    </a>
                                </li>
                                <li class="nav-item " id="itemMensualidad">
                                    <a href="{{url('mensualidad')}}" class="nav-link ">
                                        <i class="fa fa-calendar-o"></i>
                                        <span class="title">Mensualidad</span>
                                    </a>
                                </li>

                                <li class="nav-item " id="itemAdministrador">
                                    <a href="{{url('administrador')}}" class="nav-link ">
                                        <i class="fa fa-users"></i>
                                        <span class="title">Administradores</span>
                                    </a>
                                </li>
                                <li class="nav-item " id="itemColaborador">
                                    <a href="{{url('colaborador')}}" class="nav-link ">
                                        <i class="icon-user"></i>
                                        <span class="title">Tecnico</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item " id="navCooperativa">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-files-o"></i>
                                <span class="title">Cooperativa</span>
                                <span class="arrow"></span>
                            </a>
                             <ul class="sub-menu">
                                <li class="nav-item " id="itemCliente">
                                    <a href="{{url('cliente')}}" class="nav-link ">
                                        <i class="fa fa-user-friends"></i>
                                        <span class="title">Cliente</span>
                                    </a>
                                </li>
                                <li class="nav-item " id="itemMedicion">
                                    <a href="{{url('medicion')}}" class="nav-link ">
                                        <i class="fa fa-map-marked-alt"></i>
                                        <span class="title">Medición</span>
                                    </a>
                                </li>

                                <li class="nav-item " id="itemCortes">
                                    <a href="{{url('cortes')}}" class="nav-link ">
                                        <i class="fa fa-map-marked-alt"></i>
                                        <span class="title">Cortes</span>
                                    </a>
                                </li>

                                <li class="nav-item " id="itemEmergencias">
                                    <a href="{{url('emergencia')}}" class="nav-link ">
                                        <i class="fa fa-map-marked-alt"></i>
                                        <span class="title">Emergencias</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item " id="navPago">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-credit-card"></i>
                                <span class="title">Reporte y pagos</span>
                                <span class="arrow"></span>
                            </a>
                             <ul class="sub-menu">
                                <li class="nav-item " id="itemFactura">
                                    <a href="{{url('factura')}}" class="nav-link ">
                                        <i class="fa fa-id-card"></i>
                                        <span class="title">Factura</span>
                                    </a>
                                </li>
                                <li class="nav-item " id="itemReporteGeneral">
                                    <a href="{{url('reporte/reporteGeneral')}}" class="nav-link ">
                                        <i class="fa fa-list-alt"></i>
                                        <span class="title">Reporte general</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <div class="js">
                        <div id="preloader"></div>
                    </div>
                    @yield('pagebar')
                    @yield('content')

                </div>
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2023 © UAGRM
       <!--          <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a> -->
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/amcharts.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/serial.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/pie.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/radar.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/light.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/patterns.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amcharts/themes/chalk.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/ammap/ammap.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/ammap/maps/js/worldLow.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/amcharts/amstockcharts/amstock.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/highcharts/js/highcharts.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/highcharts/js/highcharts-3d.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/highcharts/js/highcharts-more.js')}}" type="text/javascript"></script>

        <script src="{{asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/table-datatables-buttons.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/pages/scripts/ui-blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/icheck/icheck.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.bxslider.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery.star-rating-svg.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/Sortable.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js')}}" type="text/javascript"></script>


        <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>

        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/dashboard.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
        $(document).ready(function () {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
              }
            });

        });

        </script>
        @stack('scripts')
        <script>
            $(window).load(function(){
                $('#preloader').fadeOut('slow',function(){$(this).remove();$});
            });
        </script>

<script>
function myFunction() {
   var element = document.body;
   
   element.classList.toggle("dark-mode");
}
</script>
    </body>

</html>