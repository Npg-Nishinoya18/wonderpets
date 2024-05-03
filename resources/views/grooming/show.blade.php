@extends('layouts.app')
@section('content')


<div class="container">
    <div class="col-md-12 col-md-offset-12">
        <h1>GROOMING SERVICE DETAIL</h1>
        @foreach($imge as $img)
              <img src="{{ asset('/images/groomings/'.$img) }}"  alt="Image Alternative text" title="Image Title"width="200" height="200"border= "5px solid #555"/>     
        @endforeach
        
        <div class="form-group mb-3">
            <label for=""><strong>Service Name: </strong></label>
            <td>{{$grooming->title}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Description: </strong></label>
            <td>{{$grooming->description}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Grooming Cost: </strong></label>
            <td>{{$grooming->grooming_cost}}</td>
        </div>
    </div>
    <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Return to Home </strong></span>  
    </a>
</div>
@endsection