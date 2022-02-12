@extends('student::layout.app')

@section('content')



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

            @if($exam)
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Opened Licence Exam</h3>
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
                                        <th>Exam Form Open Date</th>
                                        <th>Exam Form End Date</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="#">OR9842</a></td>
                                        <td>Licence Exam</td>
                                        <td>2022-12-02</td>
                                        <td>2023-01-02</td>
                                        <td><a href="{{route('apply.for.exam')}}"><span class="label label-success">Apply</span></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>

                @endif
        </div>
    </div>
    <!-- /.content -->
</div>

    @if($rejected != null)
        <div class="modal"  role="dialog" id="popup" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" onclick="$('.modal').css('display','none')" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                    </div>

                    <div class="modal-body">

                        <div class="thank-you-pop">
                            <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                            <h1>Warning! Warning! Warning!<br>
                                Profile has been rejected please review it</h1>
                            <p></p>
                            <button onclick="$('.modal').css('display','none')" class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                                Ok</button>
                            <a href="{{url("student/dashboard/student/status/index/profile")}}"><button class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                                    Check Profile logs</button></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        @endif
        <div class="modal"  role="dialog" id="popup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" onclick="$('.modal').css('display','none')" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                </div>

                <div class="modal-body">

                    <div class="thank-you-pop">
                        <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                        <h1>Thank You for Registration!<br>
                        Please Setup your Profile First for Further Operation</h1>
                        <p></p>
                        <button onclick="$('.modal').css('display','none')" class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                            Ok</button>
                        <a href="{{url("student/dashboard/student/personal")}}"><button class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                            Setup Profile</button></a>

                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    console.log("hello");
    $( document ).ready(function() {

        if(localStorage.getItem('popState') != 'shown'){
            $("#popup").delay(2000).fadeIn();
            console.log("you are pop");
            localStorage.setItem('popState','shown')
        }

        $('#popup-close, #popup').click(function(e) // You are clicking the close button
        {
            $('#popup').fadeOut(); // Now the pop up is hiden.
        });
    });
    window.onload(function() {

    });
</script>
