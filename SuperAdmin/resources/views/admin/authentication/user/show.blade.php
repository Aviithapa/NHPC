@extends('admin.layout.app')

@section('content')
    @include('admin.partials.common.page-title', ['page_title' => 'User profile'])
    <style>

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: red;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            width: 100px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
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
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
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
    <div>
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <h4>{{$user->name}}</h4>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse"></a>
                        </div>
                    </div>
                    <div class="grid-body ">
                        <div class="col-md-12">
                            <div class=" tiles white col-md-12 no-padding">
                                <div class="tiles green cover-pic-wrapper">
                                    <img src="/assets/img/cover_pic.png" alt="">
                                </div>
                                <div class="tiles white">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            <div class="user-profile-pic">
                                                <img width="69" height="69"
                                                     data-src-retina="{{$user->image?:imageNotFound('user')}}"
                                                     data-src="{{$user->image?:imageNotFound('user')}}"
                                                     src="{{$user->image?:imageNotFound('user')}}" alt="">
                                            </div>
                                            <div class="user-mini-description">
                                                <h5>Joined On:</h5>
                                                <h3 class="text-success semi-bold">
                                                    {{getDateFormat($user->created_at)}}
                                                </h3>
                                                <hr>
                                                <h5>User type:</h5>
                                                <h3 class="text-success semi-bold">
                                                    {{$user->mainRole()?$user->mainRole()->display_name:''}}                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-md-5 user-description-box col-sm-5">
                                            <h4 class="semi-bold no-margin">{{$user->name}} </h4>
                                            <h6 class="no-margin">{{$user->user_name}}</h6>
                                            <br>
                                            <p><i class="fa fa-at"></i>{{$user->email?:'N/A'}}</p>
                                            <p><i class="fa fa-phone"></i>{{$user->phone_number?:'N/A'}}</p>
                                            <p><i class="fa fa-mobile"></i>{{$user->mobile_number?:'N/A'}}</p>
                                            <p><i class="fa fa-map-marker"></i>{{$user->address?:'N/A'}}</p>
                                        </div>
                                        <div class="col-md-3  col-sm-3">
                                            <h5 class="normal">
                                                <a href="{{route('dashboard.users.edit', $user->id)}}"
                                                   class="btn btn-primary">
                                                    <span class="">
                                                        EDIT
                                                    </span>
                                                </a>
                                            </h5>
                                            <h5 class="normal">
                                                <a href="{{url('dashboard/users/rating/'.$user->id.'/'."1")}}"
                                                   class="btn btn-primary">
                                                    <span class="">
                                                        Positive Rating
                                                    </span>
                                                </a>
{{--                                                <a href="{{url('dashboard/users/rating/'.$user->id.'/'."-1")}}"--}}
{{--                                                   class="btn btn-danger">--}}
                                                    <button class=" btn btn-danger" onclick="openForm()">Negative Rating</button>
{{--                                                </a>--}}

                                                <div class="form-popup" id="myForm">
                                                    <form action="{{url('dashboard/users/rating/'.$user->id.'/'."-1")}}" class="form-container">
                                                        <label for="message"><b>Message</b></label>
                                                        <input type="text" placeholder="Enter Email" name="message" required>

                                                        <button type="submit" class="btn">Submit</button>
                                                        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                                    </form>
                                                </div>
                                            </h5>
                                             <h5 style="font-size: 36px" class="text-center">{{$user->rating}}</h5>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="tiles-body">
                                        <div class="row">
                                            <div class="post col-md-12">
                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">Company Information</div>
                                                        <div class="panel-body">
                                                            <ul>
                                                                <li>
                                                                    Company: {{$user->company_name?:'N/A'}}
                                                                </li>
                                                                <li>
                                                                    Registration
                                                                    Number: {{$user->company_registration_number?:'N/A'}}
                                                                </li>
                                                                <li>
                                                                    Vat/Pan Number: {{$user->vat_pan_no?:'N/A'}}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                    <div class="panel panel-info">
                                                        <div class="panel-heading">Contact Information</div>
                                                        <div class="panel-body">
                                                            <ul>
                                                                <li>
                                                                    Name: {{$user->contact_name?:'N/A'}}
                                                                </li>
                                                                <li>
                                                                    Email: {{$user->contact_email?:'N/A'}}
                                                                </li>
                                                                <li>
                                                                    Phone Number: {{$user->contact_phone_number?:'N/A'}}
                                                                </li>
                                                                <li>
                                                                    Mobile Number: {{$user->contact_mobile_number?:'N/A'}}

                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

  @push('scripts')
      <script>
          function openForm() {
              document.getElementById("myForm").style.display = "block";
          }

          function closeForm() {
              document.getElementById("myForm").style.display = "none";
          }
      </script>
      @endpush
