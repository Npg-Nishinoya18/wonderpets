@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12 col-md-offset-12">
        <h1>CUSTOMER'S PROFILE</h1>
        <td><img src="{{ asset('/images/customer/'.$customer->customer_img) }}" width="200" height="200" border= "5px solid #555"/></td>
        <div class="form-group mb-3">
            <label for=""><strong>Title: </strong></label>
            <td>{{$customer->title}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Last Name: </strong></label>
            <td>{{$customer->lname}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>First Name: </strong></label>
            <td>{{$customer->fname}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Town: </strong></label>
            <td>{{$customer->town}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Addressline: </strong></label>
            <td>{{$customer->addressline}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Zip Code: </strong></label>
            <td>{{$customer->zipcode}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Phone: </strong></label>
            <td>{{$customer->phone}}</td>
        </div>
    </div>
    <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Return to Home </strong></span>  
    </a>
</div>
@endsection