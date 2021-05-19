<!DOCTYPE html>
<html>
<head>
    <title>Điện lực thành phố Vinh</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <script src="{{asset('/assets/admin/js/core/pace.js')}}"></script>
    <link href="{{ mix('/assets/admin/css/laraspace.css') }}" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/assets/admin/css/style.css') }}" rel="stylesheet" type="text/css">

    @include('admin.layouts.partials.favicons')
    @yield('styles')
</head>
<body class="layout-default skin-arryn">
<main>
    @yield('content')
</main>

<script src="{{mix('/assets/admin/js/core/plugins.js')}}"></script>
<script src="{{asset('/assets/admin/js/demo/skintools.js')}}"></script>
<script src="{{mix('/assets/admin/js/core/app.js')}}"></script>
@yield('scripts')
<script>
    $(window.print());
</script>
</body>
</html>
