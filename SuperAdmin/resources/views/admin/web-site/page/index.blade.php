@extends('admin.layout.app')

@section('content')
    <div>
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <a href="{{route($commonRoute.'.create')}}"  class="btn btn-info btn-cons">
                            <i class="fa fa-plus-square"></i> Add New
                        </a>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="grid-body ">
                        <table class="table table-hover table-condensed" id="data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Image</th>
                                <th>Meta title</th>
                                <th>Meta Description</th>
                                <th class="disabled-sorting">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route($commonRoute.'.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'type', name: 'type'},
                {data: 'partner_pic', name: 'partner_pic'},
//                {data: 'status', name: 'status'},
                {data: 'meta_link', name: 'meta_link'},
                {data: 'meta_description', name: 'meta_description'},
                {className: 'td-actions', data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endpush
