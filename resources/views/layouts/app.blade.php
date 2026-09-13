<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Favicon-->
    <link rel="shortcut icon" href="{{ asset('assets/') }}/images/sslogo.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/') }}/images/sslogo.png" type="image/x-icon">

    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/sslogo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">



    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Qligence">
    <meta name="apple-mobile-web-app-title" content="Qligence">
    <meta name="theme-color" content="1fc6a7">
    <meta name="msapplication-navbutton-color" content="1fc6a7">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">

    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('/') }}assets/images/sslogo.png">
    <link rel="apple-touch-icon" type="image/png" sizes="512x512" href="{{ asset('/') }}assets/images/sslogo.png">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('/') }}assets/images/sslogo.png">
    <link rel="apple-touch-icon" type="image/png" sizes="512x512" href="{{ asset('/') }}assets/images/sslogo.png">


    <!-- CSS
        ================================================== -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/bootstrap.min.css">
    <!-- Template styles-->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/style.css">
    <!-- Responsive styles-->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/responsive.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/font-awesome.min.css">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/animate.css">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/owl.theme.default.min.css">
    <!-- Colorbox -->
    <link rel="stylesheet" href="{{ asset('assets/') }}/css/colorbox.css">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
          <script src="{{ asset('assets/') }}/js/html5shiv.js"></script>
          <script src="{{ asset('assets/') }}/js/respond.min.js"></script>
        <![endif]-->



    <title> @yield('title') | {{ config('app.name', 'SS Group') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="https:/ /www.qligence.com" />
    <meta name="robots" content="index, follow" />

    @yield('css')
    @yield('meta')
</head>

<body>

    <div class="body-inner">

        @include('frontEnd.include.preloader')
        @include('frontEnd.include.topBar')
        @include('frontEnd.include.menu')

        @yield('content')
        @include('frontEnd.include.footer')


        <!-- Javascript Files
        ================================================== -->

        <!-- initialize jQuery Library -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/jquery.js"></script>
        <!-- Bootstrap jQuery -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/bootstrap.min.js"></script>
        <!-- Owl Carousel -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/owl.carousel.min.js"></script>
        <!-- Counter -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/jquery.counterup.min.js"></script>
        <!-- Waypoints -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/waypoints.min.js"></script>
        <!-- Color box -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/jquery.colorbox.js"></script>
        <!-- Isotope -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/isotope.js"></script>
        <script type="text/javascript" src="{{ asset('assets/') }}/js/ini.isotope.js"></script>

        <!-- Template custom -->
        <script type="text/javascript" src="{{ asset('assets/') }}/js/custom.js"></script>

        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function(reg) {
                    {{--  console.log("Service worker has been registered for scope: " + reg.scope);  --}}
                });
            }
        </script>

        <!-- Google reCAPTCHA -->
        <script async src="https://www.google.com/recaptcha/api.js"></script>

        @yield('js')
    </div><!-- Body inner end -->
</body>

</html>
