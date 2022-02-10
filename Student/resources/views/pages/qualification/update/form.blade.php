@extends('student::layout.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Student Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i> Student Dashboard</li>
            </ol>
        </div>



            <div class="content">
                @if($data)
    @switch($data['level'])
      @case(1):
        @include('student::pages.qualification.update.updateSlc')
        @break
        @case(2):
      @include('student::pages.qualification.update.updateTSLC')
        @break
        @case(3):
                   @include('student::pages.qualification.update.updatePcl')

        @break
        @case(4):
                        @include('student::pages.qualification.update.updateTSLC')

                        @break
        @case(5):

                        @include('student::pages.qualification.update.updateTSLC')

                    @endswitch
                    @endif
            </div>
    </div>

    @endsection

@push('scripts')

    @include('student::parties.common.file-upload')
@endpush
