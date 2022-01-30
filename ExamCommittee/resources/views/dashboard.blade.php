<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from uxliner.com/adminkit/demo/main/ltr/index-medical.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 May 2021 17:39:43 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Student Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- v4.0.0 -->
    <link rel="stylesheet" href="{{ asset('dist/bootstrap/css/bootstrap.min.css') }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/dist/img/favicon-16x16.png')}}" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" />

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/et-line-font/et-line-font.css')}}" />
    <link rel="stylesheet" href="{{asset('/dist/css/themify-icons/themify-icons.css')}}" />
    <link rel="stylesheet" href="{{asset('dist/css/simple-lineicon/simple-line-icons.css')}}" />
</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="dashboard.html" class="logo blue-bg">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{asset('dist/img/logo-n-blue.png')}}" alt="" /></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{asset('dist/img/logo-blue.png')}}" alt="" /></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar blue-bg navbar-static-top">
            <!-- Sidebar toggle button-->
            <ul class="nav navbar-nav pull-left">
                <li>
                    <a class="sidebar-toggle" data-toggle="push-menu" href="#"></a>
                </li>
            </ul>
            <div class="pull-left search-box">
                <form action="#" method="get" class="search-form">
                    <div class="input-group">
                        <input name="search" class="form-control" placeholder="" type="text" />
                        <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
                    </div>
                </form>
                <!-- search form -->
            </div>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages -->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <div class="notify">
                                <span class="heartbit"></span> <span class="point"></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 4 new messages</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <div class="pull-left">
                                                <img src="{{asset('dist/img/img1.jpg')}}" class="img-circle" alt="User Image" />
                                                <span class="profile-status online pull-right"></span>
                                            </div>
                                            <h4>Notification</h4>
                                            <p>I've finished it! See you so...</p>
                                            <p><span class="time">9:30 AM</span></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View All Messages</a></li>
                        </ul>
                    </li>
                    <!-- Notifications  -->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <div class="notify">
                                <span class="heartbit"></span> <span class="point"></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Notifications</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <div class="pull-left icon-circle red">
                                                <i class="icon-lightbulb"></i>
                                            </div>
                                            <h4>Abhishek</h4>
                                            <p>I've finished it! See you so...</p>
                                            <p><span class="time">9:30 AM</span></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="#">Check all Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- User Account  -->
                    <li class="dropdown user user-menu p-ph-res">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('dist/img/img1.jpg')}}" class="user-image" alt="User Image" />
                            <span class="hidden-xs">Abhishek Thapa</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <div class="pull-left user-img">
                                    <img src="{{asset('dist/img/avatar.png')}}" class="img-responsive img-circle" alt="User" />
                                </div>
                                <p class="text-left">
                                    Abhishek Thapa <small>abhishek@gmail.com</small>
                                </p>
                            </li>
                            <li>
                                <a href="#"><i class="icon-profile-male"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-envelope"></i> Inbox</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#"><i class="icon-gears"></i> Account Setting</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="#"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="image text-center">
                    <img src="{{asset('dist/img/avatar.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="info">
                    <p>Abhishek Thapa</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">PERSONAL</li>
                <li class="active treeview">
                    <a href="dashboard.html">
                        <i class="icon-home"></i> <span>Dashboard</span>

                    </a>
                </li>

                <li class="treeview"> <a href="#"> <i class="icon-user"></i> <span>Profile</span> <span
                            class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li><a href="profile.html"><i class="fa fa-angle-right"></i> Personal Details</a></li>
                        <li><a href="guardian.html"><i class="fa fa-angle-right"></i> Guardian
                                Information</a>
                        </li>
                        <li><a href="specific.html"><i class="fa fa-angle-right"></i> Specific Information </a>
                        </li>
                        <li><a href="documents.html"><i class="fa fa-angle-right"></i> Documents</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Exam List</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Exam ID</th>
                                        <th>Exam Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">OR9842</a></td>
                                        <td>John Deo</td>
                                        <td><span class="label label-success">Apply</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <div class="content">

            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Recently Opened Exam List</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Exam ID</th>
                                        <th>Exam Name</th>
                                        <th>Extra</th>
                                        <th>Exam Form open day</th>
                                        <th>Exam End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">OR9842</a></td>
                                        <td>Abhishek Thapa</td>
                                        <td>abc</td>
                                        <td>12-04-2022</td>
                                        <td>12-05-2022</td>
                                        <td><span class="label label-success">Apply</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs"></div>
    Copyright © 2022 NHPC. All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('dist/js/jquery.min.js')}}"></script>

<!-- v4.0.0-alpha.6 -->
<script src="{{asset('dist/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- template -->
<script src="{{asset('dist/js/adminkit.js')}}"></script>

<!-- Morris JavaScript -->
<script src="{{asset('dist/plugins/raphael/raphael-min.js')}}"></script>
<script src="{{asset('dist/plugins/morris/morris.js')}}"></script>
<script src="{{asset('dist/plugins/functions/dashboard1.js')}}"></script>

<!-- Chart Peity JavaScript -->
<script src="{{asset('dist/plugins/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('dist/plugins/functions/jquery.peity.init.js')}}"></script>
</body>

</html>
