@extends('superAdmin::admin.layout.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Subject Committee Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Applicant Profile Details</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-lg-12 m-b-3">
                    <div class="box box-info">
                        <div class="box-header with-border p-t-1">
                            <h3 class="box-title text-black">Applicant Profile Details</h3>
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="table-responsive">
                                <table id="data-table" class="table no-margin">

                                    <thead>
                                    <tr>
                                        <th>Program Name</th>
                                        <th>Count</th>
                                        <th>Srn Number</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                            <tr>

                                                <td>TSLC in Medicine(CMA)</td>
                                                <td>
                                                    @foreach($certificates[41] as $certificate)
                                                        {{$count = $count+1}}
                                                    @endforeach</td>
                                                <td>
                                                    @foreach($certificates[41] as $certificate)
                                                    {{$certificate->srn}}
                                                @endforeach</td>


                                            </tr>
                                            <tr>

                                                <td>TSLC in MLT (Lab Asst.)</td>
                                                <td>
                                                    @foreach($certificates[42] as $certificate)

                                                        {{$certificate->srn}}
                                                    @endforeach</td>
                                            </tr>
{{--                                            <tr>--}}

{{--                                                <td>PCL in Dental Hygiene (DH)</td>--}}
{{--                                                <td>--}}
{{--                                                    @foreach($certificates[38] as $certificate)--}}


{{--                                                        {{$certificate->srn}}--}}
{{--                                                    @endforeach</td>--}}
{{--                                            </tr>--}}


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


@endsection

@push('scripts')

@endpush
