
@extends('admin.layout.app')

@section('content')
    <div class="container" style="margin-top: 30px">
        <div class="row-fluid">
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
                                    <th>Book Name</th>
                                    <th>User Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($request as $key => $book_created)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>
                                            {{$book_created->product_name}}
                                        </td>
                                        <td>
                                            {{getUserName($book_created->user_id)}}
                                        </td>
                                        <td>
                                            {{$book_created->created_at}}
                                        </td>
                                        <td>

                                            <a href="{{route('dashboard.cart.show', $book_created->id) }}">
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
        </div>
    </div>
@endsection

@push('scripts')
@endpush
