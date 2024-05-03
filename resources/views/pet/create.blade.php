@extends('layouts.base')
@section('body')
<div class="container">

<h2>Register Pet</h2>
<form method="post" action="{{route('pets.store')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
        <label for="name" class="control-label">Pet Name</label>
        <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}">
        @if($errors->has('name'))
      <small>{{ $errors->first('name') }}</small>
    @endif 
    </div>

    {{-- <div class="form-group"> 
        <label for="customer_id">Owner's Name</label>
        <select name="customer_id" id="customer_id" class="form-select">
        @foreach($users as $user)
          <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
        </select>
    </div> --}}

    <div class="form-group"> 
        <label for="type">Pet Type</label>
        <select name="type" id="type" class="form-select">
          <?php $types = ['','Dog', 'Cat', 'Bird']; ?>
          @foreach($types as $type)
            <option value={{$type}} {{(old('status') == $type?'selected':'')}} >{{$type}}</option>
          @endforeach
          @if($errors->has('type'))
            <small>{{ $errors->first('type') }}</small>
          @endif 
        </select>
    </div>

    <div class="form-group">
      <label for="image" class="control-label">Pet Image</label>
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