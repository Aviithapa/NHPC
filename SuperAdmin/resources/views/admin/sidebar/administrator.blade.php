<!-- BEGIN SIDEBAR -->
<style>
    .badge {
        position: absolute;
        margin-left: 10px;
        font-size: 16px;
        background-color: #ff682c;
        color: white;
    }
</style>
<div class="page-sidebar avoid-this" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
        <div class="user-info-wrapper sm">
            <div class="profile-wrapper sm">
                <img src="{{$authUser->getImage()}}" alt="" data-src="{{$authUser->getImage()}}" data-src-retina="{{$authUser->getImage()}}" width="69" height="69" />
                <div class="availability-bubble online"></div>
            </div>
            <div class="user-info sm">
                <div class="username"><span class="semi-bold">{{$authUser->name}}</span></div>
                <div class="status">{{$authUser->mainRole()?$authUser->mainRole()->display_name:''}}</div>
            </div>
        </div>
        <!-- END MINI-PROFILE -->
        <!-- BEGIN SIDEBAR MENU -->
        <p class="menu-title sm">BROWSE <span class="pull-right"><a href="javascript:void(0);"><i class="material-icons">refresh</i></a></span></p>
        <ul>
            <li>
                <a href="{{route('dashboard.index')}}">
                    <i class="material-icons">home</i>
                    <span class="title">Dashboard</span>
                    <span class="label label-important bubble-only pull-right "></span>
                </a>
            </li>

            <li class="start ">
                <a href="javascript:void(0)"><i class="material-icons">web</i>
                    <span class="title">Site</span> <span class="selected"></span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{route('dashboard.site-settings.index')}}">Site Setting</a></li>
                </ul>
            </li>

            <li class="start ">
                <a href="javascript:void(0)"><i class="material-icons">web</i>
                    <span class="title">CMS</span> <span class="selected"></span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{route('dashboard.banners.index')}}">Banners Management</a></li>
                    <li><a href="{{route('dashboard.posts.index')}}">Contents Management</a></li>
                    <li><a href="{{route('dashboard.events.index')}}">Events Management</a></li>
                    <li><a href="{{route('dashboard.pages.index')}}">Pages Management</a></li>
                    <li><a href="{{route('dashboard.services.index')}}">Services Management</a></li>
                    <li><a href="{{route('dashboard.testimonials.index')}}">Testimonials Management</a></li>
                    <li><a href="{{route('dashboard.blog.index')}}">Blogs Management</a></li>
                    <li><a href="{{route('dashboard.Clients.index')}}">Vendors Management</a></li>
                </ul>
            </li>
            <li class="start ">
                <a href="javascript:void(0)"><i class="material-icons">category</i>
                    <span class="title">Categories</span> <span class="selected"></span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{route('dashboard.category.index')}}">Category</a></li>
                    <li><a href="{{route('dashboard.faculty.index')}}">Faculty</a></li>
                    <li><a href="{{route('dashboard.semester.index')}}">Semester</a></li>
                </ul>
            </li>

            <li class="start ">
                <a href="javascript:void(0)"><i class="material-icons">book</i>
                    <span class="title">Book</span> <span class="selected"></span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{route('dashboard.product.index')}}">Book</a></li>
                    <li><a href="{{route('dashboard.secondhand.index')}}">Second HandBook</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('dashboard.order.index')}}">
                    <i class="fa fa-list"></i>
                    <span class="title">Orders</span>
                    <span class="badge">{{getAllProduct()}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.request.index')}}">
                    <i class="material-icons">mark_email_unread</i>
                    <span class="title">Request</span>
                    <span class="badge">{{getAllRequest()}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.cart.index')}}">
                    <i class="material-icons">shopping_bag</i>
                    <span class="title">Cart View</span>
                    <span class="badge">{{getAllCartView()}}</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.contact.index')}}">
                    <i class="fa fa-users"></i>
                    <span class="title">Contact</span>
                </a>
            </li>
            <li class="start ">
                <a href="javascript:void(0)"><i class="material-icons">rowing</i>
                    <span class="title">Auth Setting</span> <span class="selected"></span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="{{route('dashboard.users.index')}}">User</a></li>
                    <li><a href="{{route('dashboard.roles.index')}}">Role</a></li>
                    <li><a href="{{route('dashboard.permissions.index')}}">Permission</a></li>
                </ul>
            </li>
            <li>
                <a onclick="openForm()">
                    <i class="fa fa-envelope-open"></i>
                    <span class="title">Send Mail</span>
                </a>
            </li>
            <li>
                <a href="{{route('dashboard.coupons.index')}}">
                    <i class="fa fa-gift"></i>
                    <span class="title">Coupons</span>
                </a>
            </li>

        </ul>
        <div class="clearfix"></div>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<a href="#" class="scrollup">Scroll</a>
<!-- END SIDEBAR -->
<div class="form-popup" id="myForm">
    <form action="{{route("dashboard.mail.store")}}" method="POST" class="form-container">
        {{ csrf_field() }}
        <h1>Send Mail</h1>

        <label for="email"><b>Subject</b></label>
        <input type="text" placeholder="Enter Your Subject" name="subject" required>

        <div class="form-group">
            <label for="excerpt" class="form-label">Message:</label>
            {!! Form::textarea('description',null, ['class' => 'form-control ckeditor','id'=>'ckeditor']) !!}
         </div>
        <button type="submit" class="btn">Send Mail</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>


<style>


    /* The popup form - hidden by default */
    .form-popup {
        display: none; /* Hidden by default */
        position: fixed;
        z-index: 9; /* Sit on top */
        left: 0;
        top: 0;
        padding-left: 300px;
        padding-right: 300px !important;
        padding-top: 50px !important;
        padding-bottom:50px !important;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Add styles to the form container */
    .form-container {
        min-width: 500px;
        padding: 20px;
        background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 40%;
        margin-left:20px;
        opacity: 0.8;
        float: left;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
        opacity: 1;
    }
</style>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ckeditor', {
//        filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
//        filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
    } );
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>
