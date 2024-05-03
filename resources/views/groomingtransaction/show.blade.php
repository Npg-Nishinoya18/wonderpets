@extends('layouts.app')
@section('content')
<link href="{{ URL::asset('css/comment.css') }}" rel="stylesheet">
<div class="container">
    <div class="col-md-12 col-md-offset-12">
        <h1>GROOMING SERVICE DETAIL</h1>
        @foreach($imge as $img)
              <span>
              <img src="{{ asset('/images/groomings/'.$img) }}"  alt="Image Alternative text" title="Image Title"width="200" height="200"border= "5px solid #555"/></span>
        @endforeach
        <div class="form-group mb-3">
            <label for=""><strong>Service Name: </strong></label>
            <td>{{$groomingservice->title}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Description: </strong></label>
            <td>{{$groomingservice->description}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Grooming Cost: </strong></label>
            <td>{{$groomingservice->grooming_cost}}</td>
        </div>
    </div>

    <p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
    <h3>COMMENTS</h3>
    @foreach($comments as $commentss)
    <div class="comment-thread">
    <!-- Comment 1 start -->
    <div class="comment" id="comment-1">
        <div class="comment-heading">

        <div class="comment-info">
            <a href="#" class="comment-author">{{$commentss->name}} ({{$commentss->email}})</a>
            <p class="m-0">{{ \Carbon\Carbon::createFromTimestamp(strtotime($commentss->created_at))->format('F d, Y |H:i:s')}}
            </p>
        </div>
        </div>
        <div class="comment-body">
            <p>{{$commentss->comment}}</p>
        </div>
    </div>
    @endforeach

    <style>
    textarea {
        /*resize: none;
        border: 1px solid #ced4da;
        padding: .375rem .75rem;
        color: #495057;*/
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
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


    <form action="{{route('comment.create')}}" method="post">
        @csrf 
    <input type="hidden" value="{{$groomingservice->id}}" class="form-control" name="groomings_id"/>

        <div class="form-group"> 
            <label for="name" class="control-label">Name</label>
        <input type="text" class="form-control " id="name" name="name" value="{{old('name')}}">
        @if($errors->has('name'))
          <small>{{ $errors->first('name') }}</small>
        @endif 
        </div> 

        <div class="form-group"> 
            <label for="email" class="control-label">E-mail</label>
        <input type="text" class="form-control " id="email" name="email" value="{{old('email')}}">
        @if($errors->has('email'))
          <small>{{ $errors->first('email') }}</small>
        @endif 
        </div> 

      <div class="form-group"> 
        <label for="comment" class="control-label">Comment:</label>
        <textarea id="comment" name="comment" rows="4" cols="121" value="{{old('comment')}}"></textarea>
        @if($errors->has('comment'))
          <small>{{ $errors->first('comment') }}</small>
        @endif 
        </div>

        <!--<input type="submit" value="Submit">-->
        <div>
          <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
        </div>   
    </form> 
</div>
@endsection