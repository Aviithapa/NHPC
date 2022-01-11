<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel = "icon" class="img-fluid" href ="" type = "image/x-icon">
    <title></title>
    @include('student::layout.style')
    @stack('styles')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="skin-blue sidebar-mini">
@include('student::layout.header')
@include('student::layout.sidebar')
<!-- BEGIN CONTAINER -->
@include('student::pages.flash-message')

@yield('content')
<!-- END CONTAINER -->
@include('student::layout.footer')
@include('student::layout.script')
@stack('scripts')
</body>
</html>
