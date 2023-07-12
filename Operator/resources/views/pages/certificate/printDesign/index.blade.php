@extends('operator::layout.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Operator Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Operator Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">

                
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("operator.dashboard.printCertificateDashboard",['status'=>$status,'level_name'=> 'Specialization'])}}">

                            <div class="card">
                                <div class="card-body">
                                    <div class="info-box-content">

                                        <button class="mt-3" style="border:none; font-weight: bold; font-size: 14px; color: white; background: blue;">Specilization / Master</button>
                                </div>
                            </div>
                        </a>
                    </div>
            </div>
                      
                    <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("operator.dashboard.printCertificateDashboard",['status'=>$status,'level_name'=> 'First'])}}">

                            <div class="card">
                                <div class="card-body">
                                    <div class="info-box-content">

                                        <button class="mt-3" style="border:none; font-weight: bold; font-size: 14px; color: white; background:blue">First / Bachelor</button>
                                </div>
                            </div>
                        </a>
                    </div>
        </div>

                     <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("operator.dashboard.printCertificateDashboard",['status'=>$status,'level_name'=> 'Second'])}}">

                            <div class="card">
                                <div class="card-body">
                                    <div class="info-box-content">

                                        <button class="mt-3" style="border:none; font-weight: bold; font-size: 14px; color: white; background: blue;">Second / PCL</button>
                                </div>
                            </div>
                        </a>
                    </div>
    </div>

                     <div class="col-lg-3 col-xs-6 m-b-3">
                        <a href="{{route("operator.dashboard.printCertificateDashboard",['status'=>$status,'level_name'=> 'Third'])}}">

                            <div class="card">
                                <div class="card-body">
                                    <div class="info-box-content">

                                        <button class="mt-3" style="border:none; font-weight: bold; font-size: 14px; color: white; background: blue;">Third / TSLC</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    
                    </div>
         
        </div>
            </div>
        </div>

    </div>
    <!-- /.content -->
    </div>



@endsection
