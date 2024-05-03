@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12 col-md-offset-12">
        <h1>PET'S PROFILE</h1>
        <td><img src="{{ asset('/images/pet/'.$pet->pet_img) }}" width="200" height="200" border= "5px solid #555"/></td>
        <div class="form-group mb-3">
            <label for=""><strong>Pet Name: </strong></label>
            <td>{{$pet->name}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Type: </strong></label>
            <td>{{$pet->type}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Owner: </strong></label>
            <td>{{$user->name}}</td>
        </div>

    <a href="{{url()->previous()}}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Return to Home </strong></span>  
    </a>
    </div>
</div>
@endsection