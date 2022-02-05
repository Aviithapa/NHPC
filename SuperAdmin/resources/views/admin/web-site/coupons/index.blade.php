@extends('admin.layout.app')

@section('content')
    <div>
        <div class="row-fluid">
            <div class="span12">
                <div class="grid simple ">
                    <div class="grid-title">
                        <a href="{{route('dashboard.coupons.create')}}"  class="btn btn-info btn-cons">
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
                                <th>Coupons Name</th>
                                <th>Status</th>
                                <th>Discount</th>
                                <th>Valid Date</th>
                                <th>Total Used</th>
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
            ajax: '{{ route('dashboard.coupons.index') }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'coupons_name', name: 'coupons_name'},
               {data: 'status', name: 'status'},
                {data: 'discount', name:'discount'},
                {data:"valid_date", name:'valid_date'},
                {data:"count_used_coupons", name:'count_used_coupons'},
                {className: 'td-actions', data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    </script>
@endpush
