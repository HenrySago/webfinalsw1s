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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{asset('assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="{{asset('assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
         </head>
        <style>
            .login {
                background-color: #4f646a !important;
            }
            .login .content h3 {
                color: #4f646a;
                text-align: center;
                font-size: 28px;
                font-weight: 700!important;
            }
            .login .content .form-actions .btn {
                margin-top: 1px;
                font-weight: 600;
                padding: 10px 20px!important;
                background-color: #4f646a;
                color: white;
            }
            .title-logo{
                font-size: 37px;
                font-weight: 800;
                color: white;
            }
            .title-logo img {
                width: 150px;
                position: relative;
                height: 150px;
                margin-top: -4px;
                object-fit: contain;
            }
            .login .copyright {
                text-align: center;
                margin: 0 auto 30px 0;
                padding: 10px;
                color: #ffffff;
                font-size: 13px;
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
            .input-group {
              margin-bottom: 1.25em;
            }
            input[type="text"],
            input[type="password"] {
              -webkit-appearance: none;
              border-radius: 1px;
              box-sizing: border-box;
              font-size: 1em;
              height: auto;
              padding: .5em;
            }
            input[type="password"]::-ms-reveal {
              display: none;
            }
            .btn {
              margin-top: 1.75em;
            }
            .input-group {
              position: relative;
              width: 100%;
            }
            .toggle {
              background: none;
              border: none;
              color: #4f646a !important;
              font-weight: 600;
              position: absolute;
              right: .75em;
              top: 2.6em;
              z-index: 9;
              outline:none;
            }
            .fa {
              font-size: 2rem;
            }
        </style>

    <body class=" login">

        <div class="logo">
                <h6 class="title-logo"><img src="{{asset('images/logo.png')}}" alt="logo"></h6> 
        </div>
    
        <div class="content">

            <form class="login-form" method="POST" action="{{url('login/iniciarSesion')}}">
                @csrf
                <h3 class="form-title">Iniciar Sesión</h3>
                <div class="input-group">
                    <label for="correo">Correo electronico</label>
                    <input type="text" class="form-control" name="correo" placeholder="Correo electronico" />
                </div>
                <div class="input-group">
                    <label for="credencial">Contraseña</label>
                    <input type="password" id="credencial" class="form-control" name="credencial" placeholder="Password"/>
                    <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn uppercase col-md-12">Ingresar</button>
                </div>
            </form>
         
         
        </div>
        <div class="copyright"> 2023 © Derechos reservados. </div>
 
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
        <script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="{{asset('assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            let passwordInput = document.getElementById('credencial'),
                toggle = document.getElementById('btnToggle'),
                icon =  document.getElementById('eyeIcon');

            function togglePassword() {
              if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.add("fa-eye-slash");
                //toggle.innerHTML = 'hide';
              } else {
                passwordInput.type = 'password';
                icon.classList.remove("fa-eye-slash");
                //toggle.innerHTML = 'show';
              }
            }
            toggle.addEventListener('click', togglePassword, false);
        </script>
    </body>

</html>