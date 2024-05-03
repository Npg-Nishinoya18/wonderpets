@extends('layouts.base')
@section('body')
<div class="container">
    <h2>Edit Grooming Transaction</h2>
    {{ Form::model($transactions,['route' => ['transaction.update',$transactions->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) }}

    <div class="form-group">
        <label for="petName" class="control-label">Pet Name</label>
        {{ Form::text('petName',null,array('class'=>'form-control','id'=>'petName'), 'readonly')}}
        @if($errors->has('petName'))
        <small>{{ $errors->first('petName') }}</small>
        @endif 
    </div> 

    <div class="form-group">
        <label for="title" class="control-label">Service Name</label>
        {{ Form::text('title',null,array('class'=>'form-control','id'=>'title', 'readonly')) }}
        @if($errors->has('title'))
        <small>{{ $errors->first('title') }}</small>
        @endif 
    </div> 

    <div class="form-group">
        <label for="status" class="control-label">Payment Status</label>
        {{ Form::text('status',null,array('class'=>'form-control','id'=>'status')) }}
    </div> 

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>     
</div>
{!! Form::close() !!} 
@endsection