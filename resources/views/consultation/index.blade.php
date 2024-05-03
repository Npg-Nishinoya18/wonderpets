@extends('layouts.base')
@section('content')

<link href="{{ URL::asset('css/searchstyle.css') }}" rel="stylesheet">
<div class="container">

    <h3>Pet Consultation</h3>
        <a href="{{route('consultation.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-kit-medical"></i><strong> Add Consultation</strong></span>  
        </a>

    <form action="{{url('search')}}" method="GET" class="forms">
        <input type="search" placeholder="Search" class="search-field" name="search" required/>
        <button type="submit" class="search-button">
          <img src="https://www.kindacode.com/wp-content/uploads/2020/12/search.png">
        </button>
    </form>

        <!-- <form method="GET" action="{{url('search')}}" >
            {{-- <div class="container"> --}}
                 <label for="genre">Search</label>
                 <input type="text" class="form-control" name="search" id="genre">
         {{-- </div> --}}
          </form> -->

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Checkup ID</th>
                <th>Pet Name</th>
                <th>Veterinarian's Name</th>
                <th>Date Consulted</th>
                <th>Disease/ Injury</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($consultations as $consultation)
            <tr>
                <td>{{$consultation->id}}</td>
                <td>{{$consultation->petname}}</td>
                <td>{{$consultation->vetname}}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($consultation->date_serviced))->format('F d, Y')}}</td>
                <td>{{$consultation->diseases_injuries}}</td>
                <td>{{$consultation->comment}}</td>     
            @endforeach
            </table>
        </div>
@endsection