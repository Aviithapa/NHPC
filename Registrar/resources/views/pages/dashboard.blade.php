@extends('registrar::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Registrar Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Registrar Dashboard</li>
            </ol>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'progress', 'current_state' => 'registrar'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-briefcase"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Reviewing', 'registrar')}}</span>
                                    <span class="info-box-text">New Applicant Profile List</span> </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'Pending', 'current_state' => 'registrar'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Pending','registrar')}}</span>
                                    <span class="info-box-text">Applicant Pending Profile</span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <a href="{{route("registrar.applicant.profile.list", ['status'=> 'Rejected','current_state' => 'student'])}}">
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-red"><i class="icon-reload"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{getApplicantCount('Rejected','student')}}</span>
                                    <span class="info-box-text">Rejected Application List </span></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-yellow"><i class="icon-book-open"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('pending')}}</span>
                                <span class="info-box-text">Exam Applied Application List</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('accepted')}}</span>
                                <span class="info-box-text">Exam Applicant Accepted List</span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('rejected')}}</span>
                                <span class="info-box-text">Exam Applicant Rejected List</span> </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6 m-b-3">
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-clock"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{getExamApplicantList('processing')}}</span>
                                <span class="info-box-text">Exam Applicant Processing List</span> </div>
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
                            <h3 class="box-title text-black">Total Applicant List : {{getTotalApplication()}}</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">
                                    <thead>
                                    <td>S.N.</td>
                                    <td>State</td>
                                    <td>Verified Student</td>
                                    <td>Rejected Student</td>
                                    <td>Pending Student</td>
                                    </thead>
                                    <tbody>
{{--                                    @if($data === null)--}}
{{--                                        <tr>--}}
{{--                                            <td> No Applicant List found at Computer Operator</td>--}}
{{--                                        </tr>--}}

{{--                                    @else--}}
{{--                                        @foreach($data as $exam)--}}
                                            <tr>
                                                <td>1</td>
                                                <td>Computer Operator</td>
                                                <td>{{getVerifiedStudent('officer', 'Reviewing')}}</td>
                                                <td>{{getprofileVerifiedStudent('computer_operator', 'rejected')}}</td>
                                                <td>{{getVerifiedStudent('computer_operator', 'Reviewing')}}</td>
                                            </tr>
<tr>
    <td>2</td>
    <td>Officer</td>
    <td>{{getVerifiedStudent('registrar', 'Reviewing')}}</td>
    <td>{{getprofileVerifiedStudent('officer', 'rejected')}}</td>
    <td>{{getVerifiedStudent('officer', 'Reviewing')}}</td>
</tr>
<tr>
    <td>3</td>
    <td>Registrar</td>
    <td>{{getVerifiedStudent('subject_committee', 'Reviewing')}}</td>
    <td>{{getprofileVerifiedStudent('registrar', 'rejected')}}</td>
    <td>{{getVerifiedStudent('registrar', 'Reviewing')}}</td>
</tr>
<tr>
    <td>4</td>
    <td>Subject Committee</td>
    <td>{{getVerifiedStudent('exam_committee', 'Reviewing')}}</td>
    <td>{{getprofileVerifiedStudent('subject_committee', 'rejected')}}</td>
    <td>{{getVerifiedStudent('subject_committee', 'Reviewing')}}</td>
</tr>
<tr>
    <td>5</td>
    <td>Exam Committee</td>
    <td></td>
    <td></td>
    <td></td>
</tr>
{{--                                        @endforeach--}}
{{--                                    @endif--}}
                                    </tbody>
                                    {{--                                                @foreach($data as $datas)--}}
                                    {{--                                                    <tr>--}}
                                    {{--                                                        <td>{{$datas->first_name}}</td>--}}
                                    {{--                                                        <td></td>--}}
                                    {{--                                                        <td>{{$datas->getLevelName()}}</td>--}}
                                    {{--                                                            <td> <a href="#"><span class="label label-danger">Not-Verified</span></a></td>--}}
                                    {{--                                                        <td> <a href="{{url("operator/dashboard/operator/applicant-list/".$datas->id)}}"><span class="label label-success">View</span></a></td>--}}
                                    {{--                                                            </tr>--}}
                                    {{--                                                @endforeach--}}

                                    {{--                                            </tbody>--}}
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
                            <h3 class="box-title text-black">Profile Status Pie Chart</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 m-b-12">
                                    <div id="piechart" style="width: 600px; height: 400px"></div>
                                </div>
                                <div class="col-lg-6 m-b-12">
                                    <div id="pieChart" style="width: 600px; height:400px"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



{{--        Bar Graph --}}


        <div class="row">
            <div class="col-lg-8">
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12 m-b-3">
                            <div class="box box-info">
                                <div class="box-header with-border p-t-1">
                                    <h3 class="box-title text-black">Exam Applied Program Wise Application</h3>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-lg-12 m-b-12">
                                            <div id="piechartProgram" style="width: 100%; height: 500px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-5">
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12 m-b-3">
                            <div class="box box-info">
                                <div class="box-header with-border p-t-1">
                                    <h3 class="box-title text-black">Exam Applied Count</h3>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                        <div class="table-responsive">
                                            <table id="data-table" class="table no-margin">
                                                <thead>
                                                <td>Program Name</td>
                                                <td>Count</td>
                                                </thead>
                                                <tbody>
                                                @foreach($exams as $exam)
                                                <tr>
                                                    <td>{{$exam->getProgramName()}}</td>
                                                    <td>{{$exam->count}}</td>
                                                </tr>
                                                @endforeach

                                                </tbody>

                                            </table>
                                           <div class="pagination">
                                               {{ $exams->links() }}
                                           </div>
<style>
    .w-5{
        height: 10px;
    }
    .flex-1{
        display: none;
    }
    .cursor-default{
        height: 5px;
        width: 5px;
        /*margin: 5px;*/
    }
</style>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- /.content -->
</div>



@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.3.2/echarts.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Order Id', 'Price', 'Product Name'],

                @php
                    foreach($data as $order) {
                        echo "['".$order->profile_status."', ".$order->profile_state.", ".$order->profile_status."],";
                    }
                @endphp
            ]);

            var options = {
                chart: {
                    title: 'Bar Graph | Price',
                    subtitle: 'Price, and Product Name: @php echo $data[0]->created_at @endphp',
                },
                bars: 'vertical'
            };
            var chart = new google.charts.Bar(document.getElementById('bars'));
            console.log(chart);
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Reviewing', 'Rejected'],

                @php

                    foreach($data as $d) {
                        echo "['".$d->profile_status."', ".$d->count."],";
                    }
                @endphp
            ]);

            var options = {
                title: 'Profile Status',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }




    </script>

    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Reviewing', 'Rejected'],

                @php

                    foreach($exam as $d) {
                        echo "['".$d->getProgramName()."', ".$d->count."],";
                    }
                @endphp
            ]);

            var options = {
                title: 'Exam Apply Program Wise',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechartProgram'));

            chart.draw(data, options);
        }




    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Reviewing', 'Rejected'],

                @php

                    foreach($profile as $d) {
                        echo "['".$d->profile_state."', ".$d->count."],";
                    }
                @endphp
            ]);

            var options = {
                title: 'Profile State',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('pieChart'));

            chart.draw(data, options);
        }
    </script>


@endpush
