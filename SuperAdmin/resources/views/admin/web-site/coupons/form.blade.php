@if(isset($model))
    {{ Form::model($model, ['url' => route('dashboard.coupons.update', $model->id), 'method' => 'PUT','files' => true]) }}
@else
    {{ Form::open(['url' => route('dashboard.coupons.store'), 'method' => 'post', 'files' => true]) }}
@endif

<div class="grid simple ">
    <div class="grid-title">
        <h4>Coupons Info</h4>
        <div class="tools">
            <a href="javascript:;" class="collapse"></a>
        </div>
    </div>
    <div class="grid-body ">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('Coupon_Name', 'Coupon Name:', ['class' => 'form-label']) !!}
                    {!! Form::text('coupons_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('coupons_name', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('discount', 'Discount %:', ['class' => 'form-label']) !!}
                    {!! Form::number('discount',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('discount', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="form-group">
                    {!! Form::label('valid_date', 'Valid Upto:', ['class' => 'form-label']) !!}
                    {!! Form::date('valid_date',null, ['class' => 'form-control']) !!}
                    {!! $errors->first('valid_date', '<div class="text-danger">:message</div>') !!}
                </div>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <input type="submit" value="Save" class="btn btn-primary"/>
            <a href="{{URL::previous()}}" class="btn btn-danger">Cancel</a>
        </div>
    </div>
</div>



{{ Form::close() }}


@push('scripts')
    @include('admin.partials.common.file-upload');
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
@endpush
