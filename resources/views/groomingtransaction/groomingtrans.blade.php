@extends('layouts.base')
@section('content')

<link href="{{ URL::asset('css/searchstyle.css') }}" rel="stylesheet">
<div class="container">

    <h3>Grooming Transactions</h3>
        <a href="{{route('groomingtransaction.index')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-kit-medical"></i><strong> Add New Transaction</strong></span>  
        </a>

    <form action="{{route('searching')}}" method="GET" class="forms">
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
                <th>Service ID</th>
                <th>Date of Service</th>
                <th>Pet Name</th>
                <th>Owner's Name</th>
                <th>Grooming Service</th>
                {{-- <th>Cost</th> --}}
                <th>Employee's Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groomingstrans as $groomingtrans)
            <tr>
                <td>{{$groomingtrans->serviceID}}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($groomingtrans->dateServiced))->format('F d, Y')}}</td>
                <td>{{$groomingtrans->petname}}</td>
                <td>{{$groomingtrans->cusID}}</td>  
                <td>{{$groomingtrans->gsTitle}}</td>
                {{-- <td>{{$groomingtrans->gsCost}}</td> --}}
                <td>{{$groomingtrans->name}}</td>   
            @endforeach
            </table>
        </div>
@endsection