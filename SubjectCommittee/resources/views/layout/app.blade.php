<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel = "icon" class="img-fluid" href ="" type = "image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    @include('subjectCommittee::layout.style')
    @stack('styles')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="skin-blue sidebar-mini">
@include('subjectCommittee::layout.header')
@include('subjectCommittee::layout.sidebar')
<!-- BEGIN CONTAINER -->
@include('subjectCommittee::pages.flash-message')

@yield('content')
<!-- END CONTAINER -->
@include('subjectCommittee::layout.footer')
@include('subjectCommittee::layout.script')
@stack('scripts')
</body>
</html>
