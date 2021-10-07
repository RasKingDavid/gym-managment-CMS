<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->
<?php $settings = Utilities::getSettings(); ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <title>{{ $settings['gym_name'] }} - Login</title>

    <!-- BEGIN CORE FRAMEWORK -->
    <link href="{{ URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <!-- END CORE FRAMEWORK -->

    <!-- BEGIN PLUGIN STYLES -->
    <link href="{{ URL::asset('assets/plugins/animate/animate.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.css') }}" rel="stylesheet"/>
    <!-- END PLUGIN STYLES -->

    <!-- BEGIN THEME STYLES -->
    <link href="{{ URL::asset('assets/css/material.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/plugins.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/helpers.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/responsive.css') }}" rel="stylesheet"/>
    <link href="{{ URL::asset('assets/css/mystyle.css') }}" rel="stylesheet"/>
    @include('custom_style')

    <!-- END THEME STYLES -->
</head>
<body class="auth-page height-auto bg-grey-600">
<div class="wrapper animated fadeInLeft">
    <div class="panel overflow-hidden">
        <div class="login padding-40 no-margin-bottom font-size-20 color-white text-center text-uppercase">
           @if ($settings['gym_logo'] != '')
            <img src="{{ asset('media/company_image/' .$settings['gym_logo']) }}" width="100" height="100">
            @else 
            <h4>{{ $settings['gym_name'] }}</h4>
           @endif
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="loginform" method="post" action="{{ url('/auth/login') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <div class="box-body padding-md">

                <div class="form-group">
                    <input type="text" name="email" class="form-control input-lg" placeholder="Email"/>
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control input-lg" placeholder="Password"/>
                </div>

                <div class="form-group margin-top-20">
                    <div class="checkbox checkbox-theme">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark login padding-10 btn-block color-white"><i class="ion-log-in"></i> Sign in</button>
            </div>
        </form>
        <div class="panel-footer login padding-md no-margin no-border text-center color-white">&copy; {{ date('Y') }} {{ $settings['gym_name'] }} @ All riht Reserve</div>
    </div>
</div>

<!-- Javascript -->
<script src="{{ URL::asset('assets/plugins/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/core.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- bootstrap validator -->
<script src="{{ URL::asset('assets/plugins/bootstrapValidator/bootstrapValidator.min.js') }}" type="text/javascript"></script>

<!-- Login Validators -->
<script src="{{ URL::asset('assets/js/login.js') }}" type="text/javascript"></script>

<!-- gymie -->
<script src="{{ URL::asset('assets/js/gymie.js') }}" type="text/javascript"></script>
</body>
</html>