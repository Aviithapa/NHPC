@extends('admin.layout.app')

@section('content')
    @include('admin.partials.common.page-title', ['page_title' => 'Product View'])
    <div class="container" style="margin-top: 30px">
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple ">
                    <div class="grid-body ">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h3><span>Book Name : {{$request->bookName}}</span></h3>
                                <h3><span>Faculty : {{$request->faculty}}</span></h3>
                                <h3> <span>Publication :{{$request->publication}}</span></h3>
                                <h3><span>Message : {{$request->message}}</span><br></h3>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h1>User Details</h1>
                                <h3><span>{{$request->name}}</span><br></h3>
                                <h3><span>{{$request->phoneNumber}}</span><br></h3>
                                <h3> <span>{{$request->email}}</span><br></h3>
                                <h3> <span>{{$request->created_at}}</span><br></h3>
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


@endpush
