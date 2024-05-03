@extends('layouts.base')
@section('title')
  {{-- item --}}
@endsection
@section('body')

{{-- {{dd($searchResults->groupByType())}} --}}
<link href="{{ URL::asset('css/tables.css') }}" rel="stylesheet">
<div class = "container">
  <h3><span>Customer's History</span></h3>


<div class="table-wrapper">
    <table class="fl-table">
  <tr align ="center">
    <td colspan="2">There are {{ $cushistory->count() }} Results.</td>
  </tr>

  @foreach($searchResults->groupByType() as $type => $modelSearchResults)
     
     @foreach($modelSearchResults as $searchResult)

            <tr>
              <td>Customer Name:</td>
              <td><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></td>
            </tr>

            <tr>
              <td>Customer ID:</td>
              <td>{{$searchResult->searchable->id}}</td>
            </tr>

            <tr>
              <td>Email:</td>
              <td>{{$searchResult->searchable->email}}</td>
            </tr>


          </table>
          </div>
        
     @endforeach
  @endforeach

@if($cushistory->isNotEmpty())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Service ID</th>
                <!-- <th>Customer ID</th>
                <th>Customer Name</th> -->
                <th>Pet's Name</th>
                <!-- <th>Groomer's Name</th> -->
                <th>Service Name</th>
                <th>Amount</th>
                <th>Date Serviced</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cushistory as $cushistories)
            <tr>
                <td>{{$cushistories->serviceID}}</td>
               <!--  <td>{{$cushistories->userID}}</td>
                <td>{{$cushistories->userName}}</td> -->
                <td>{{$cushistories->petname}}</td>
                <td>{{$cushistories->gsTitle}}</td>
                <td>{{$cushistories->gsCost}}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($cushistories->date_Serviced))->format('F d, Y')}}</td>   
            @endforeach
            </table>
        </div>
@else 
    <div>
        <h3>Sorry, but the Customer does not have any transaction at ACME Webapplication!</h3>
    </div>
@endif
</div>

@endsection