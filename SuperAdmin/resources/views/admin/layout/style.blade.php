<!-- BEGIN PLUGIN CSS -->
<link href="{{asset('assets/plugins/jquery-notifications/css/messenger.css')}}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{asset('assets/plugins/jquery-notifications/css/messenger-theme-flat.css')}}" rel="stylesheet" type="text/css" media="screen" />
<!-- BELOW CSS FILE IS NOT REQUIRED -->
<link href="{{asset('assets/plugins/jquery-notifications/css/location-sel.css')}}" rel="stylesheet" type="text/css" media="screen" />

<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrap-select2/select2.css')}}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{asset('assets/plugins/jquery-datatable/css/jquery.dataTables.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables-responsive/css/datatables.responsive.css')}}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-datepicker/css/datepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
<!-- BEGIN PLUGIN CSS -->
<link href="{{asset('assets/plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{asset('assets/plugins/bootstrapv3/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/bootstrapv3/css/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="{{asset('assets/plugins/animate.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('nestable/nestable.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('assets/sweetalert2/dist/sweetalert2.css')}}" rel="stylesheet" type="text/css" />



<!-- END PLUGIN CSS -->
<!-- BEGIN CORE CSS FRAMEWORK -->
<link href="{{asset('webarch/css/themes/webarch.coporate.css')}}" rel="stylesheet" type="text/css" />
<!-- END CORE CSS FRAMEWORK -->
{{--<!-- Font Awesome CDN -->--}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"/>
<!-- Bootstrap-Iconpicker -->
<link rel="stylesheet" href="{{asset('assets/plugins/font-awesome/bootstrap-iconpicker.min.css')}}"/>
<style>
    .dataTables_processing {
        text-align: center;
        padding-top: 10px;
        vertical-align: middle;
        background-color: rgba(11,11,11,0.1);
        color: white;
        height: 35px;
        z-index: 999;
    }

    .single-colored-widget .content-wrapper.yellow {
        background-color: #f3c319;
    }
    .single-colored-widget .content-wrapper.yellow p {
        color: #835819;
    }

    select, input[type="file"] {
        border: none;
    }

    .td-actions {
        min-width: 150px;
    }

    .u-hide {
        display: none;
    }

    .horizontal-style {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
    }

    .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
    }

    .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
    }

    .rating label:last-child {
        position: static;
    }

    .rating label:nth-child(1) {
        z-index: 5;
    }

    .rating label:nth-child(2) {
        z-index: 4;
    }

    .rating label:nth-child(3) {
        z-index: 3;
    }

    .rating label:nth-child(4) {
        z-index: 2;
    }

    .rating label:nth-child(5) {
        z-index: 1;
    }

    .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .rating label .icon {
        float: left;
        color: transparent;
    }

    .rating label:last-child .icon {
        color: #000;
    }

    .rating:not(:hover) label input:checked ~ .icon,
    .rating:hover label:hover input ~ .icon {
        color: #09f;
    }

    .rating label input:focus:not(:checked) ~ .icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #09f;
    }
    .icon {
        font-size: 50px !important;
    }
    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }
    .thumb{
        height: 250px;
        width: 80%;
        padding-right:20px ;
    }
    .social-fix {
        position: fixed;
        right: -100px;
        top: 300px;
        z-index: 111;
        box-shadow: 0 0 15px rgba(165, 165, 165, 0.56);
    }
    .social-fix li {
        background: #fff;
        padding: 15px 60px 20px 15px;
        transition: .5s all;
        color: #FF8800;
    }
    .social-fix li:hover {
        transform: translateX(-90px);
        background:#FF8800 !important;
        border-radius: 40px 0 0 40px;
        transition: .5s all;
        color: #fff !important;
        cursor: pointer;
        padding: 15px 25px 20px 10px;
    }
    .social-fix i{
        position: relative;
        top: 5px;
        padding-right: 10px;

    }
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
    .pip {
        display: inline-block;
        position: relative;
    }
    .remove {
        position: absolute;
        top: 0;
        color: red;
    }

</style>
