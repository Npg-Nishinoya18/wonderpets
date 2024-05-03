@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12 col-md-offset-12">
        <h1>PET'S CONSULTATION INFO</h1>
        <div class="form-group mb-3">
            <label for=""><strong>Pet Checkup ID: </strong></label>
            <td>{{$checkup->id}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Pet Name: </strong></label>
            <td>{{$pet->name}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Type: </strong></label>
            <td>{{$pet->type}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Veterinarian's Name: </strong></label>
            <td>{{$user->name}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Date Consulted: </strong></label>
            <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($serviceinfo->date_serviced))->format('F d, Y')}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Diseases/ Injuries: </strong>{{$checkup->diseases_injuries}}</label>
            <td></td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Comment: </strong>{{$checkup->comment}}</label>
            <td></td>
        </div>

    <a href="{{url()->previous()}}" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Return to Home </strong></span>  
    </a>
    </div>
</div>
@endsection