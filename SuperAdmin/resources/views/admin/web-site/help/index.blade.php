
@extends('admin.layout.app')

@section('content')
    <div class="container" style="margin-top: 30px">
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="grid-body ">
                        <table class="table table-hover table-condensed" id="data-table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Book Name</th>
                                <th>Category</th>
                                <th>Image</th>
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
            ajax: '{{ route('dashboard.products.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'sub_category', name: 'sub_category'},
                {data: 'product_image', name: 'product_image'},
               {data: 'status', name: 'status'},
            {className: 'td-actions', data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endpush
