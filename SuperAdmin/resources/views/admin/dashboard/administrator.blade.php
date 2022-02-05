
@extends('admin.layout.app')

@section('content')
    <div class="container">
        <div class="row 2col">
            <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
                <div class="tiles blue added-margin">
                    <div class="tiles-body">
                        <div class="controller">
                            <a href="javascript:;" class="reload"></a>
                            <a href="javascript:;" class="remove"></a>
                        </div>
                        <div class="tiles-title"> YOUR TOTAL PRODUCT </div>
                        <div class="heading"> <span class="animate-number" data-value="{{getAllProductQuanity()}}" data-animation-duration="1200">0</span> </div>
                        <div class="progress transparent progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="{{getAllProductQuanity()}}%"></div>
                        </div>
                        <div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp;{{getAllProductQuanity()}} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 spacing-bottom-sm spacing-bottom">
                <div class="tiles green added-margin">
                    <div class="tiles-body">
                        <div class="controller">
                            <a href="javascript:;" class="reload"></a>
                            <a href="javascript:;" class="remove"></a>
                        </div>
                        <div class="tiles-title"> YOUR SECOND HAND  PRODUCTS </div>
                        <div class="heading"> <span class="animate-number" data-value="{{getSecondHandProductQuanity()}}" data-animation-duration="1000">0</span> </div>
                        <div class="progress transparent progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="{{getSecondHandProductQuanity()}}%"></div>
                        </div>
                        <div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; {{getSecondHandProductQuanity()}} <span class="blend"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 spacing-bottom">
                <div class="tiles red added-margin">
                    <div class="tiles-body">
                        <div class="controller">
                            <a href="javascript:;" class="reload"></a>
                            <a href="javascript:;" class="remove"></a>
                        </div>
                        <div class="tiles-title"> TODAY’S ORDER </div>
                        <div class="heading"> <span class="animate-number" data-value="{{getTodayRequests()}}" data-animation-duration="1200">0</span> </div>
                        <div class="progress transparent progress-white progress-small no-radius">
                            <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="{{getTodayRequests()}}"></div>
                        </div>
                        <div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 5% higher <span class="blend">than last month</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="tiles purple added-margin">
                    <div class="tiles-body">
                        <div class="controller">
                            <a href="javascript:;" class="reload"></a>
                            <a href="javascript:;" class="remove"></a>
                        </div>
                        <div class="tiles-title"> TOTAL EARNING </div>
                        <div class="row-fluid">
                            <div class="heading"> <span class="animate-number" data-value="{{TotalSell()}}" data-animation-duration="700">0</span> </div>
                            <div class="progress transparent progress-white progress-small no-radius">
                                <div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="12%"></div>
                            </div>
                        </div>
                        <div class="description"><i class="icon-custom-up"></i><span class="text-white mini-description ">&nbsp; 3% higher <span class="blend">than last month</span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="tiles white">
                    <div class="tiles-body">
                        <div class="tiles-title"> <strong>New Book Requests</strong></div>
                        <br>
                        <table class="table table-hover table-condensed" id="basic-data-table">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($book_created as $key => $book_created)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$book_created->name}}
                                    </td>
                                    <td>
                                        {{$book_created->category}}
                                    </td>
                                    <td>
                                        {{$book_created->status}}
                                    </td>
                                    <td>

                                        <a href="{{route('dashboard.product.show', $book_created->id) }}">
                                        <button type="submit" class="btn btn-success btn-xs btn-mini">
                                            <i class="fa fa-eye"></i>View
                                        </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
