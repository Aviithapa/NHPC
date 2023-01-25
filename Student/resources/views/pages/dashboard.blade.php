@extends('student::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
        {{-- @if(isset($examApplied) ? $examApplied->isEmpty() : false) --}}
        <li><i class="fa fa-angle-right"></i>  Student Dashboard </li>
        {{-- @endif --}}
            </ol>
        </div>


       
        @if($examApplied == null || $examApplied->isNotEmpty())
        
        @if(isset($data->first_name))
        @if($specific_program == null)
        <div class="content">
            @if($licenceExam)
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Licenced Exam</h3>
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
                                        <td><a href="#">{{ $licenceExam->id}}</a></td>
                                        <td>{{ $licenceExam->Exam_name }}</td>
                                        <td>{{ $licenceExam->form_opening_date }}</td>
                                        <td>{{ $licenceExam->form_closing_date }}</td>
                                        <td><a href="{{route('apply.for.exam',['id' => $licenceExam->id ])}}"><span class="label label-success">Apply</span></a></td>
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

            @if($rejected != null)
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Licenced Exam</h3>
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
                                        <td><a href="#">1</a></td>
                                        <td>Fifth Licence Exam</td>
                                        <td></td>
                                        <td></td>
                                        <td><a href="{{route('apply.for.exam',['id' => 3 ])}}"><span class="label label-success">Apply</span></a></td>
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
            @if($exam)
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">TSLC Licenced Voucher</h3>
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
                                        <td>TSLC Licence Exam</td>
                                        <td>
                                            <a href="{{route('apply.for.exam')}}"><span class="label label-success">Apply</span></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria- 
            labelledby="demoModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="demoModalLabel">Applying for TSLC</h5>
								<button type="button" class="close" data-dismiss="modal" aria- 
                                label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
						</div>
						<div class="modal-body">
								You are applying for TSLC are you sure you want to continue?
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data- 
                            dismiss="modal">No</button>
                            <a href="{{route('apply.for.exam')}}"><span class="label label-success">Yes</span></a>
						</div>
					</div>
				</div>
			</div>

            

                @endif
        </div>
        @else
        <div class="content">
            
        <div class="card">
            <div class="card-body conatiner">
                <span class="text-justify text-danger">
                   You have successfully enrolled in the {{isset($licenceExam->Exam_name) ? $licenceExam->Exam_name : 'fifth licence exam'}} please wait until next message
                </span>

            </div>
        </div>
        @endif
        @else
        <div class="content">
            <div class="card">
                <div class="card-body">
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Personal Information</strong></li>
                        <li id="personal"><strong>Guardian Information</strong></li>
                        <li  id="payment"><strong>Collage Information</strong></li>
                    </ul> <!-- fieldsets -->
                </div>
            </div>

            <div class="card">
                <div class="card-body conatiner">
                    <span class="text-justify text-danger">
                        To apply for the license exam, please set up your profile and submit your qualifications.

                    </span>

                </div>
            </div>
        @endif
    </div>
    <!-- /.content -->
</div>

    @if(!$data)
        <div class="modal show"  role="dialog" style="display: block"  >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="font-weight: bold; color: red; font-size: 16px; line-height: 20px; text-align: center;">कृपया आफ्नो दर्ता हुन चाहेको कार्यक्रम (बिषय)  र तह चयन गर्नुहोस ।   Please select the application level and program name.</h3>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="{{ url('student/dashboard/level/program') }}">
                            @csrf
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>स्तर / Level  *</label>
                                    <select class="form-control" name="level" id="level" onchange="getPracticular()" required>
                                        <option value="">Select Your Level </option>
                                        @foreach($level as $key => $value)
                                             @if($value->id === 5)

                                                 @else
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>कार्यक्रम नाम / Program Name</label>
                                    <select class="form-control" name="program_name" id="program"   required>
                                        <option value="">Select Program</option>
                                    </select>
                                </fieldset>
                            </div>
                            <button type="submit" class="btn btn-primary float-right"><i class="fa fa-check"></i> Save </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endif


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
                            <a href="{{url("student/dashboard/student/status/index/profile")}}"><button class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                                    Check Profile logs</button></a>

                        </div>

                    </div>
                </div>
            </div>
        </div>

       

        @endif
    @if($exam_re != null)
        <div class="modal"  role="dialog" id="popup" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                                         </div>

                    <div class="modal-body">

                        <div class="thank-you-pop">
                            <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
                            <h1>Warning! Warning! Warning!<br>
                                {{$exam_re}}</h1>
                            <p></p>
                            <a href="{{route('apply.for.exam')}}"><button class="btn btn-primary  mt-2"><i class="fa fa-check"></i>
                                    Appy for Exam</button></a>

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
  
  
  
  
  
  @endif
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

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        function getPracticular(){
            var level_id = document.getElementById("level").value;
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
            $.ajax({
                type : 'Get',
                url : '{{URL::to('student/dashboard/level/program')}}',
                data:{'level_id':level_id},
                success:function(data){
                    console.log(" The data is" + data);
                    $('#program').html(data);
                }
            });
        }
    </script>
@endpush
