@extends('layouts.base')
@section('body')
<div class="container">

<h2>Add Grooming Service</h2>
<form method="post" action="{{route('grooming.store')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="title" class="control-label">Service Name</label>
        <input type="text" class="form-control" id="title" name="title"  value="{{old('title')}}">
        @if($errors->has('title'))
      <small>{{ $errors->first('title') }}</small>
    @endif 
    </div>

    <div class="form-group"> 
        <label for="description" class="control-label">Description</label>
    <input type="text" class="form-control " id="description" name="description" value="{{old('description')}}">
    @if($errors->has('description'))
      <small>{{ $errors->first('description') }}</small>
    @endif 
  </div> 

  <div class="form-group"> 
    <label for="grooming_cost" class="control-label">Service Cost</label>
    <input type="number" class="form-control " id="grooming_cost" name="grooming_cost" step = "0.01" value="{{old('grooming_cost')}}">
    @if($errors->has('grooming_cost'))
      <small>{{ $errors->first('grooming_cost') }}</small>
    @endif 
  </div>

  <div class="form-group">
    <label for="image" class="control-label">Grooming Service Image</label>
    <input type="file" class="form-control" id="image" name="image">
    @error('image')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div>
  <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
    </div>     
  </div>
  </form> 
@endsection