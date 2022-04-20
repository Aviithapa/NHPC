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



            <div class="content">
                @if($data)
    @switch($data['level'])
      @case(1):
        @include('superAdmin::admin.qualification.update.updateSlc')
        @break
        @case(2):
      @include('superAdmin::admin.qualification.update.updateTSLC')
        @break
        @case(3):
                   @include('superAdmin::admin.qualification.update.updatePcl')

        @break
        @case(4):
                        @include('superAdmin::admin.qualification.update.updateBachlor')

                        @break
        @case(5):

                        @include('superAdmin::admin.qualification.update.updateMaster')

                    @endswitch
                    @endif
            </div>
    </div>

    @endsection

@push('scripts')

    @include('student::parties.common.file-upload')
@endpush
