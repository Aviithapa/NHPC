@extends('operator::layout.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header sty-one">
            <h1>Computer Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><i class="fa fa-angle-right"></i>Computer Dashboard</li>
            </ol>
        </div>

        <!-- Main content -->
        <div class="content">

            <div class="content">
                <div class="card mt-5">

                    <div class="card-body">


                        <h4 class="text-black">Information Related to Allocate Certificate</h4>


                            <div class="content">
                                    <form method="POST" action="{{route('operator.uploadAllocate')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <input type="hidden" name="certificate_profile_id" class="form-control" value="{{ $certificate_id }}"/>
                                                
                                                 <fieldset class="form-group">
                                                         <input type="text" id="profile-search"  class="form-control" placeholder="Search profiles...">

                                                </fieldset>

                                                <fieldset class="form-group">
                                                    <label>Allocate</label>
                                                  
                                                     <select class="form-control" name="profile_id" id="category-filter" required>
                                                            @foreach($kycs  as $kyc)
                                                   
                                                            <option value="{{$kyc->profile_id}}">{{$kyc->name}}, {{ $kyc->dob }}, {{ $kyc->symbol_number }}, {{$kyc->profile_id}}</option>
                                                            @endforeach
                                                        </select>
                                                </fieldset>
                                            </div>
                                            
                                        
                                           
                                        </div>

                                        <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i>
                                            Allocate Certificate</button>

                                    </form>

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
    <script>
        $('.dropify').dropify();
    </script>
    @include('student::parties.common.file-upload')
   

    <script>
  $(document).ready(function() {
    $('#profile-search').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      $('#category-filter option').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
@endpush