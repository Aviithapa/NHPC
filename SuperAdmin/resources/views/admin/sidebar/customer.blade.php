<!-- BEGIN SIDEBAR -->
<style>
    /* The Modal (background) */
    .w3-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width : 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .w3-modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .w3-button {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .w3-button:hover,
    .w3-button:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    span:hover{
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
        padding: 2px 16px;
    }

    /* Add Animation */
    @-webkit-keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @keyframes slideIn {
        from {bottom: -300px; opacity: 0}
        to {bottom: 0; opacity: 1}
    }

    @-webkit-keyframes fadeIn {
        from {opacity: 0}
        to {opacity: 1}
    }

    @keyframes fadeIn {
        from {opacity: 0}
        to {opacity: 1}
    }
</style>
<div class="page-sidebar" id="main-menu" style="background: #ffffff !important;">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
        <div class="user-info-wrapper sm">
            <div class="profile-wrapper sm">
                <img src="{{$authUser->getImage()}}" alt="" data-src="{{$authUser->getImage()}}" data-src-retina="{{$authUser->getImage()}}" width="69" height="69" />
                <div class="availability-bubble online"></div>
            </div>
            <div class="user-info sm">
                <div class="username"><span class="semi-bold" style="color: black">{{$authUser->name}}</span></div>
                <div class="status" style="color: #0A2640">{{$authUser->mainRole()?$authUser->mainRole()->display_name:''}}</div>
            </div>
        </div>
        <!-- END MINI-PROFILE -->
        <!-- BEGIN SIDEBAR MENU -->
        <h4 class="menu-title lg">Explore <span class="pull-right"><a href="javascript:void(0);"><i class="material-icons">refresh</i></a></span></h4>
        <ul>
            <li>
                <a href="{{route('dashboard.index')}}">
                    <i class="material-icons">home</i>
                    <span class="title" style="color: black !important;">Dashboard</span>
                    <span class="label label-important bubble-only pull-right "></span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.products.create')}}">
                    <i class="material-icons">book</i>
                    <span class="title" style="color: black !important;">Add Book</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.products.index')}}">
                    <i class="fa fa-book"></i>
                    <span class="title" style="color: black !important;">My Books</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">book</i>
                <span class="title" style="color: black !important;" onclick="document.getElementById('id01').style.display='block'">Terms and Condition</span>
                </a>
            </li>

        </ul>
        <div class="clearfix"></div>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<a href="#" class="scrollup">Scroll</a>
<!-- END SIDEBAR -->


