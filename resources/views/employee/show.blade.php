@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12 col-md-offset-12">
        <h1>EMPLOYEE'S PROFILE</h1>
        <td><img src="{{ asset('/images/employee/'.$employee->user_img) }}" width="200" height="200" border= "5px solid #555"/></td>
        <div class="form-group mb-3">
            <label for=""><strong>Name: </strong></label>
            <td>{{$employee->name}}</td>
        </div>
        
        <div class="form-group mb-3">
            <label for=""><strong>Role: </strong></label>
            <td>{{$employee->role}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>E-mail: </strong></label>
            <td>{{$employee->email}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Password: </strong></label>
            <td>{{$employee->password}}</td>
        </div>
    </div>
    <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Return to Home </strong></span>  
    </a>

</div>
@endsection