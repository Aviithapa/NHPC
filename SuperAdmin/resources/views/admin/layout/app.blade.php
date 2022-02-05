<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <link rel = "icon" href ="{{getSiteSetting('logo_image') != null? getSiteSetting('logo_image'): ''}}" type = "image/x-icon">
    <title> {{ config('app.site_name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="Abhishek Thapa" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('superAdmin::admin.layout.style')
    @stack('styles')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
@include('superAdmin::admin.layout.header')
<!-- BEGIN CONTAINER -->
<div class="page-container row-fluid">

    @include('superAdmin::admin.sidebar.superAdmin::administrator')


<!-- BEGIN PAGE CONTAINER-->
    <div class="page-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="content bg-dark">
            @yield('content')
        </div>
    </div>
</div>
<!-- END CONTAINER -->
@include('superAdmin::admin.layout.script')
@include('superAdmin::admin.layout.notification')
@stack('scripts')
</body>
</html>

