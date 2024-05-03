@extends('layouts.base')
@section('body')
<div class="container">

  <style>
  textarea {
    /*resize: none;
    border: 1px solid #ced4da;
    padding: .375rem .75rem;
    color: #495057;*/
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 100%;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    background-color: #f8fafc;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  }
  </style>

<h2>Consult Pet</h2>
<form method="post" action="{{route('consultation.store')}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group"> 
        <label for="pet_id">Pet's Name</label>
        <select name="pet_id" id="pet_id" class="form-select">
        @foreach($pets as $pet)
          <option value="{{$pet->id}}">{{$pet->name}}</option>
        @endforeach
        </select>
    </div>

    {{-- <div class="form-group"> 
        <label for="user_id">Veterinarian's Name</label>
        <select name="user_id" id="user_id" class="form-select">
        @foreach($user as $users)
          @if($users->role == 'Veterinarian')
            <option value="{{$users->id}}">
               {{$users->name}}
            </option>
          @endif
        @endforeach
        </select>
    </div> --}}

    <div class="form-group"> 
        <label for="diseases_injuries">Diseases/ Injuries</label>
        <select name="diseases_injuries" id="diseases_injuries" class="form-select">
          <?php $diseases_injuries = ['','Worm', 'ForeignBodyIngestion', 'Cancer', 'Accident', 'Ringworm', 'Tick', 'Others (Specify the Injury or Disease in the Comment Section.)']; ?>
          @foreach($diseases_injuries as $disease_injury)
            <option value={{$disease_injury}} {{(old('status') == $disease_injury?'selected':'')}} >{{$disease_injury}}</option>
          @endforeach
          @if($errors->has('disease_injury'))
            <small>{{ $errors->first('disease_injury') }}</small>
          @endif 
        </select>
    </div>

  <div class="form-group"> 
    <label for="cost" class="control-label">Cost</label>
    <input type="number" class="form-control " id="cost" name="cost" value="{{old('cost')}}">
    @if($errors->has('cost'))
      <small>{{ $errors->first('cost') }}</small>
    @endif 
  </div>

  <div class="form-group"> 
    <label for="comment" class="control-label">Observation/ Comment:</label>
    <textarea id="comment" name="comment" rows="4" cols="121" value="{{old('comment')}}"></textarea>
    @if($errors->has('comment'))
      <small>{{ $errors->first('comment') }}</small>
    @endif 
  </div> 

  <div>
  <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
    </div>     
  </div>
  </form> 
@endsection