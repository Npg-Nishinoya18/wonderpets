@extends('layouts.base')
@section('body')
<div class="container">
  
<h2>Register</h2>
<form method="post" action="{{route('user.signup')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="title" class="control-label">Title</label>
        <input type="text" class="form-control" id="title" name="title"  value="{{old('title')}}">
        @if($errors->has('title'))
      <small>{{ $errors->first('title') }}</small>
    @endif 
    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}">
        @if($errors->has('name'))
      <small>{{ $errors->first('name') }}</small>
    @endif 
    </div>

    <div class="form-group"> 
        <label for="addressline" class="control-label">Addressline</label>
    <input type="text" class="form-control " id="addressline" name="addressline" value="{{old('addressline')}}">
    @if($errors->has('addressline'))
      <small>{{ $errors->first('addressline') }}</small>
    @endif 
  </div> 

  <div class="form-group"> 
        <label for="town" class="control-label">Town</label>
    <input type="text" class="form-control " id="town" name="town" value="{{old('town')}}">
    @if($errors->has('town'))
      <small>{{ $errors->first('town') }}</small>
    @endif 
  </div> 

  <div class="form-group"> 
        <label for="phone" class="control-label">Phone</label>
    <input type="text" class="form-control " id="phone" name="phone" value="{{old('phone')}}">
    @if($errors->has('phone'))
      <small>{{ $errors->first('phone') }}</small>
    @endif 
  </div> 

  <div class="form-group"> 
    <label for="email" class="control-label">E-mail</label>
    <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
    @if($errors->has('email'))
      <small>{{ $errors->first('email') }}</small>
    @endif 
  </div>

  <div class="form-group"> 
    <label for="password" class="control-label">Password</label>
    <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}">
    @if($errors->has('password'))
      <small>{{ $errors->first('password') }}</small>
    @endif 
  </div>

  <div class="form-group">
    <label for="image" class="control-label">Profile Image</label>
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