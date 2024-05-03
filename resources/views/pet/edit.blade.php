@extends('layouts.base')
@section('body')
<div class="container">
    <h2>Edit Pet</h2>
    {{ Form::model($pet,['route' => ['pet.update',$pet->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) }}
    <!-- {{csrf_field()}} if di gagamit ng larative collective need toh--> 
    <!-- {{ method_field('PUT') }} -->
    <div class="form-group">
        <label for="name" class="control-label">Pet Name</label>
        {{ Form::text('name',null,array('class'=>'form-control','id'=>'name')) }}
        @if($errors->has('name'))
        <small>{{ $errors->first('name') }}</small>
        @endif 
    </div> 

    <div class="form-group"> 
        <label for="customer_id" class="control-label">Owner</label>
        {!! Form::select('customer_id',$customers, $pet->customer_id,['class' => 'form-control form-select']) !!}
    </div>

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

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>     
</div>
{!! Form::close() !!} 
@endsection