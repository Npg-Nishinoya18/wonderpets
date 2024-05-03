@extends('layouts.base')
@section('body')
<div class="container">
    <h2>Edit Customer</h2>
{{ Form::model($customer,['route' => ['customer.update',$customer->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) }}
<!-- {{csrf_field()}} if di gagamit ng larative collective need toh--> 
<!-- {{ method_field('PUT') }} -->
    <div class="modal-body mx-3" id="editcustomerModal">
        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
            width: 150px; ">Title</label>
            {{ Form::text('title',null,array('class'=>'form-control','id'=>'title')) }}
        </div>
        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
            width: 150px; ">Name</label>
           {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}
        </div>
        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
            width: 150px; ">Addressline</label>
            {{ Form::text('addressline',null,array('class'=>'form-control','id'=>'addressline')) }}
        </div>
        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
            width: 150px; ">Town</label>
           {{ Form::text('town',null,array('class'=>'form-control','id'=>'town')) }}
        </div>
        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
            width: 150px; ">Phone</label>
             {{ Form::number('phone',null,array('class'=>'form-control','id'=>'phone')) }}
        </div>
        <div class="md-form mb-5">
            <i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block; 
            width: 150px; ">Image</label>
            <input type="file" id="image" class="form-control validate" name="image">
        </div>
        <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
        </div>
    </form>
</div>
</div>
</div>
</div>     
</div>
{!! Form::close() !!} 
@endsection