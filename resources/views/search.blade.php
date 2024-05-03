@extends('layouts.base')
@section('title')
  {{-- item --}}
@endsection
@section('body')

{{-- {{dd($searchResults->groupByType())}} --}}
<link href="{{ URL::asset('css/tables.css') }}" rel="stylesheet">
<div class = "container">
  <h3><span>Medical History</span></h3>


<div class="table-wrapper">
    <table class="fl-table">
  <tr align ="center">
    <td colspan="2">There are {{ $medhistory->count() }} Consultation Results.</td>
  </tr>

  @foreach($searchResults->groupByType() as $type => $modelSearchResults)
     
     @foreach($modelSearchResults as $searchResult)

            <tr>
              <td>Pet Name:</td>
              <td><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a></td>
            </tr>        
            <tr>
              <td>Pet ID:</td>
              <td>{{$searchResult->searchable->id}}</td>
            </tr>
<!--             <tr>
              <td>Date Consulted:</td>
              <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($searchResult->searchable->created_at))->format('F d, Y')}}</td>
            </tr> -->
            <tr>
              <td>Type:</td>
              <td>{{$searchResult->searchable->type}}</td>
            </tr>
<!--             <tr>
              <td>Diseases/ Injuries:</td>
              <td>{{$searchResult->searchable->diseases_injuries}}</td>
            </tr>
            <tr>
              <td>Cost:</td>
              <td>{{$searchResult->searchable->cost}}</td>
            </tr> -->

          </table>
          </div>
        
     @endforeach
  @endforeach

  @if($medhistory->isNotEmpty())
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
               <!--  <th>Pet ID</th>
                <th>Pet Name</th> -->
                <th>Veterinarian's Name</th>
                <th>Date Consulted</th>
                <th>Disease/ Injury</th>
                <th>Comment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medhistory as $medhistories)
            <tr>
                <!-- <td><a href="{{route('consultation.show',$medhistories->id)}}">{{$medhistories->id}}</td>
                <td>{{$medhistories->name}}</td> -->
                <td>{{$medhistories->vetName}}</td>
                <td><a href="{{route('consultation.show',$medhistories->petID)}}">{{ \Carbon\Carbon::createFromTimestamp(strtotime($medhistories->date_serviced))->format('F d, Y')}}</td>
                <td>{{$medhistories->diseases_injuries}}</td>
                <td>{{$medhistories->comment}}</td>     
            @endforeach
            </table>
        </div>
@else 
    <div>
        <h3>Sorry, but your pet does not have any record at ACME Webapplication!</h3>
    </div>
@endif
</div>

@endsection