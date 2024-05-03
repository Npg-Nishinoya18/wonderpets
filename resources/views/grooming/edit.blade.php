@extends('layouts.base')
@section('body')
<div class="container">
    <h2>Edit Grooming Service</h2>
    {{ Form::model($grooming,['route' => ['grooming.update',$grooming->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) }}
    <!-- {{csrf_field()}} if di gagamit ng larative collective need toh--> 
    <!-- {{ method_field('PUT') }} -->
    <div class="form-group">
        <label for="title" class="control-label">Service Name</label>
        {{ Form::text('title',null,array('class'=>'form-control','id'=>'title')) }}
        @if($errors->has('title'))
        <small>{{ $errors->first('title') }}</small>
        @endif 
    </div> 

    <div class="form-group"> 
        <label for="description" class="control-label">Description</label>
        {{ Form::text('description',null,array('class'=>'form-control','id'=>'description')) }}
        @if($errors->has('description'))
        <small>{{ $errors->first('description') }}</small>
        @endif 
    </div> 

    <div class="form-group"> 
        <label for="grooming_cost" class="control-label">Service Cost</label>
        {{ Form::text('grooming_cost',null,array('class'=>'form-control','id'=>'grooming_cost')) }}
        @if($errors->has('grooming_cost'))
        <small>{{ $errors->first('grooming_cost') }}</small>
        @endif 
    </div>

    <div class="form-group">
    <label for="image" class="control-label">Grooming Service Image</label>
    <input type="file" class="form-control" name="image[]" multiple>
        @error('image')
          <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>     
</div>
{!! Form::close() !!} 
@endsection