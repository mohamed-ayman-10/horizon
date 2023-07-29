<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets')}}/images/brand/favicon.ico">

    <!-- TITLE -->
    <title>Horizon | Login Admin</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{asset('assets')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
    <link href="{{asset('assets')}}/css/style.css" rel="stylesheet">

    <!-- Plugins CSS -->
    <link href="{{asset('assets')}}/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="{{asset('assets')}}/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="{{asset('assets')}}/switcher/css/switcher.css" rel="stylesheet">
    <link href="{{asset('assets')}}/switcher/demo.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

</head>

<body class="app sidebar-mini ltr login-img">

<!-- BACKGROUND-IMAGE -->
<div class="">

    <!-- GLOABAL LOADER -->
    <div id="global-loader">
        <img src="{{asset('assets')}}/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOABAL LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="">
            <!-- Theme-Layout -->

            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto mt-7">
                <div class="text-center">
                    {{--                        <a href="index.html"><img src="{{asset('assets')}}/images/brand/logo-white.png" class="header-brand-img" alt=""></a>--}}
                    <h2>Horizon</h2>
                </div>
            </div>

            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form action="{{route('admin.auth.postLogin')}}" method="post" class="login100-form validate-form">
                        @csrf
                        <span class="login100-form-title pb-5">
                                Login
                            </span>
                        <div class="panel panel-primary">
                            <div class="panel-body tabs-menu-body p-0 pt-5">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab5">
                                        <div class="wrap-input100 validate-input input-group"
                                             data-bs-validate="Valid email is required: ex@abc.xyz">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" name="email"
                                                   value="{{old('email')}}" type="email" placeholder="Email">
                                        </div>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password"
                                                   name="password" placeholder="Password">
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <button type="submit" class="login100-form-btn btn-primary">
                                                Login
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- End PAGE -->

</div>
<!-- BACKGROUND-IMAGE CLOSED -->

<!-- JQUERY JS -->
<script src="{{asset('assets')}}/js/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SHOW PASSWORD JS -->
<script src="{{asset('assets')}}/js/show-password.min.js"></script>

<!-- GENERATE OTP JS -->
<script src="{{asset('assets')}}/js/generate-otp.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{asset('assets')}}/plugins/p-scroll/perfect-scrollbar.js"></script>

<!-- Color Theme js -->
<script src="{{asset('assets')}}/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{asset('assets')}}/js/custom.js"></script>

<!-- Custom-switcher -->
<script src="{{asset('assets')}}/js/custom-swicher.js"></script>

<!-- Switcher js -->
<script src="{{asset('assets')}}/switcher/js/switcher.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{$error}}")
        </script>
    @endforeach
@endif

</body>

</html>
