@extends('superAdmin::admin.layout.app')

@section('content') 

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header sty-one">
        <h1>Super Admin Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Super Admin Dashboard</li>
        </ol>
    </div>

    <!-- Main content -->
    <div class="content">

        <div class="content">
            <div class="card">

                <div class="card-body">


                    <h4 class="text-black">Student Details</h4>


                    <div class="row">
            
                    <div class="col-lg-4 col-xs-6 m-b-3">
                     
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">{{ isset($appliedCount) ? count($appliedCount) : '' }}</span>
                                        <span class="info-box-text">Total Applied Student</span></div>
                                </div>
                            </div>
        
                    </div>


                    <div class="col-lg-4 col-xs-6 m-b-3">
                     
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">{{ isset($rejectedCount) ? count($rejectedCount) : '' }}</span>
                                    <span class="info-box-text">Total Rejected Student</span></div>
                            </div>
                        </div>
    
                </div>

                <div class="col-lg-4 col-xs-6 m-b-3">
                     
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">{{ isset($failedCount) ? count($failedCount) : '' }}</span>
                                <span class="info-box-text">Total Failed Student</span></div>
                        </div>
                    </div>

            </div>

                    </div>


                    <h4 class="text-black">Verified List</h4>


                    <div class="row">
            
                    <div class="col-lg-4 col-xs-6 m-b-3">
                     
                            <div class="card">
                                <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                    <div class="info-box-content"> <span class="info-box-number">500</span>
                                        <span class="info-box-text">Total Applied Student</span></div>
                                </div>
                            </div>
        
                    </div>


                    <div class="col-lg-4 col-xs-6 m-b-3">
                     
                        <div class="card">
                            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                                <div class="info-box-content"> <span class="info-box-number">500</span>
                                    <span class="info-box-text">Total Passed Student</span></div>
                            </div>
                        </div>
    
                </div>

                <div class="col-lg-4 col-xs-6 m-b-3">
                     
                    <div class="card">
                        <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
                            <div class="info-box-content"> <span class="info-box-number">500</span>
                                <span class="info-box-text">Total Failed Student</span></div>
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