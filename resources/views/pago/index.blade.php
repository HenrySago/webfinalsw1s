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
        <link href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/clockface/css/clockface.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/global/plugins/morris/morris.css')}}" rel="stylesheet" type="text/css" />


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
        <link rel="stylesheet" href="{{ asset('css/card/card.css') }}">
        <script type="text/javascript" src="https://h.online-metrix.net/fp/tags.js?org_id={{$df_org_id}}&session_id={{$merchant_id}}{{$session_id}}"></script>
        <!-- END THEME LAYOUT STYLES -->
         </head>
        @stack('links')
        <style>
            .form-control:focus {
                border-color: #3498DB;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(255, 0, 0, 0.6);
                border-width: 2px;
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

        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="container">
                    <h4 style="margin-bottom: 1em;"> Los campos con <strong style="color: red;">*</strong> son obligatorios</h4>
                    <div class="row portlet-body">

                            @if(Session::has('message'))
                            <h3> <strong style="color: red;">{{ Session::get('message') }}</strong> </h3>
                            @endif

                        <form method="post" action="{{url('api/pago/confirmar')}}" id="formulario" enctype="multipart/form-data">
                            <input type="hidden" name="profile_id" value="{{$profile_id}}">
                            <input type="hidden" name="access_key" value="{{$access_key_secure_acceptance}}">
                            <input type="hidden" name="transaction_uuid" value="{{$transaction_uuid}}">
                            <input type="hidden" name="signed_date_time" value="{{$signed_data_time}}">

                            <input type="hidden" name="signed_field_names" value="profile_id,access_key,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,auth_trans_ref_no,amount,currency,merchant_descriptor,override_custom_cancel_page,override_custom_receipt_page,payment_method">
                            
                            <input type="hidden" name="unsigned_field_names" value="device_fingerprint_id,signature,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_line2,bill_to_address_city,bill_to_address_state,card_type,card_number,card_expiry_date,card_cvn,bill_to_address_country,bill_to_address_postal_code,customer_ip_address,line_item_count,item_0_code,item_0_sku,item_0_name,item_0_quantity,item_0_unit_price,merchant_defined_data1,merchant_defined_data2,merchant_defined_data4,merchant_defined_data6,merchant_defined_data9,merchant_defined_data11,merchant_defined_data87,merchant_defined_data90,merchant_defined_data7,merchant_defined_data12,merchant_defined_data15,merchant_defined_data19,merchant_defined_data23,merchant_defined_data24">


                            <input type="hidden" name="override_custom_cancel_page" value="{{url('api/pago/callback'.'/'.$token)}}">
                            <input type="hidden" name="override_custom_receipt_page" value="{{url('api/pago/callback'.'/'.$token)}}">

                            <input type="hidden" name="customer_ip_address" value="{{$customer_ip_address}}">
                            <input type="hidden" name="device_fingerprint_id" value="{{$session_id}}">


                            <input type="hidden" name="line_item_count" value="1"/>

                            <input type="hidden" name="item_0_sku" value="sku1"/>
                            <input type="hidden" name="item_0_code" value="code1">
                            <input type="hidden" name="item_0_name" value="name1">
                            <input type="hidden" name="item_0_quantity" value="1">
                            <input type="hidden" name="item_0_unit_price" value="{{$factura->medicion->total}}">
                       

                            <input type="hidden" name="merchant_defined_data1" value="SI">
                            <input type="hidden" name="merchant_defined_data2" value="01-01-22">
                            <input type="hidden" name="merchant_defined_data4" value="01-01-22">

                            <input type="hidden" name="merchant_defined_data6" value="SI">
                            <input type="hidden" name="merchant_defined_data9" value="Pagina Web">
                            <input type="hidden" name="merchant_defined_data11" value="7736734SC">
                            <input type="hidden" name="merchant_defined_data87" value="1111222233334444">
                            <input type="hidden" name="merchant_defined_data90" value="Servicio">


                            <input type="hidden" name="merchant_defined_data7" value="LectorMedidor">
                            <input type="hidden" name="merchant_defined_data12" value="68836930">
                            <input type="hidden" name="merchant_defined_data15" value="1000">
                            <input type="hidden" name="merchant_defined_data19" value="7736724">
                            <input type="hidden" name="merchant_defined_data23" value="q43tq4xctc43gmail">
                            <input type="hidden" name="merchant_defined_data24" value="2">

                            <input type="hidden" name="transaction_type" value="sale">
                            <input type="hidden" name="reference_number" value="{{$identificador}}">
                            <input type="hidden" name="auth_trans_ref_no" value="{{$identificador}}">
                            <input type="hidden" name="amount" value="{{$factura->medicion->total}}">
                            <input type="hidden" name="currency" value="USD">
                            <input type="hidden" name="locale" value="es">
                            <input type="hidden" name="merchant_descriptor" value="LectorMedidor">
                            
                            <input type="hidden" name="bill_to_address_line1" maxlength="60"  value="5to anillo">
                            <input type="hidden" name="bill_to_address_line2" maxlength="60" value="Santos dumont">
                            <input type="hidden" name="bill_to_address_city" value="Santa Cruz de la sierra">
                            <input type="hidden" name="payment_method" value="card">
                            <input type="hidden" name="card_type" value="">
                            
                            <input type="hidden" name="bill_to_address_country" value="BO">
                            <input type="hidden" name="bill_to_address_postal_code" value="94043">


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="card-wrapper"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Número de tarjeta <strong class="required" aria-required="true">*</strong></label>
                                    <input type="tel" id="card_number" name="card_number" class="form-control form-control-sm" placeholder="Número de tarjeta" value="" required="">
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nombres <strong class="required" aria-required="true">*</strong></label>
                                    <input type="text" id="bill_to_forename" name="bill_to_forename" class="form-control form-control-sm" placeholder="Nombres" value="" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Apellidos <strong class="required" aria-required="true">*</strong></label>
                                    <input type="text" id="bill_to_surname" name="bill_to_surname" class="form-control form-control-sm" placeholder="Apellidos" value="" required="">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Correo electrónico <strong class="required" aria-required="true">*</strong></label>
                                    <input type="email" id="bill_to_email" name="bill_to_email" class="form-control form-control-sm" placeholder="Correo electrónico" value="" required="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Número de celular <strong class="required" aria-required="true">*</strong></label>
                                    <input type="number" id="bill_to_phone" name="bill_to_phone" class="form-control form-control-sm" placeholder="Número de celular" value="" required=""> 
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="single-append-text" class="control-label">Seleccione la ciudad <strong class="required" aria-required="true">*</strong></label>
                                    <select class="js-example-basic-single" id="bill_to_address_state" name="bill_to_address_state" required>
                                        <option value="">Seleccione una ciudad</option>
                                        <option value="BOS">Santa Cruz</option>
                                        <option value="BOH">Chuquisaca</option>
                                        <option value="BOC">Cochabamba</option>
                                        <option value="BOB">Beni</option>
                                        <option value="BOL">La Paz</option>
                                        <option value="BOO">Oruro</option>
                                        <option value="BON">Pando</option>
                                        <option value="BOP">Potosi</option>
                                        <option value="BOT">Tarija</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Expiración <strong class="required" aria-required="true">*</strong></label>
                                    <input type="tel" id="card_expiry_date" name="card_expiry_date" class="form-control form-control-sm" placeholder="MM/YYYY" value="" required=""> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label>CVN <strong class="required" aria-required="true">*</strong></label>
                                    <input type="number" id="card_cvn" name="card_cvn" class="form-control form-control-sm" placeholder="CVN" value="" required=""> 
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>

                         

                            <div class="form-body col-md-12" style="margin-top: 1em;">
                                <button class="btn orange" type="submit">Continuar</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2022 © UAGRM
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
        <script src="{{asset('assets/pages/scripts/ui-blockui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/clockface/js/clockface.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
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
        <script src="{{ asset('js/card/card.js') }}"></script>
         <noscript>
         <iframe style="width: 100px; height: 100px; border: 0; position:absolute; top: -5000px;" src="https://h.online-metrix.net/fp/tags?org_id={{$df_org_id}}&session_id={{$merchant_id}}{{$session_id}}"></iframe>
         </noscript>
        <script>
        $(document).ready(function () {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
              }
            });
            new Card({
                form: 'form#formulario',
                container: '.card-wrapper',
                formSelectors: {
                    nameInput: 'input[name="bill_to_forename"], input[name="bill_to_surname"]',
                    numberInput: 'input[name="card_number"]',
                    expiryInput:  'input[name="card_expiry_date"]',
                    cvcInput:  'input[name="card_cvn"]'
                }
            });

            $('#bill_to_address_state').select2({
                    placeholder: "Seleccione la ciudad",
                    allowClear: true,
                    width: 'auto'
            });

        });

        </script>
        @stack('scripts')
        
    </body>

</html>