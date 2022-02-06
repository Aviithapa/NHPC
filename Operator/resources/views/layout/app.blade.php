<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel = "icon" class="img-fluid" href ="" type = "image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    @include('operator::layout.style')
    @stack('styles')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="skin-blue sidebar-mini">
@include('operator::layout.header')
@include('operator::layout.sidebar')
<!-- BEGIN CONTAINER -->
@include('operator::pages.flash-message')

@yield('content')
<!-- END CONTAINER -->
@include('operator::layout.footer')
@include('operator::layout.script')
@stack('scripts')
</body>
</html>
