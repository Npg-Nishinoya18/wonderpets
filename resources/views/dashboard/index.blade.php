@extends('layouts.base')
@section('content')
<div class="container">
  <div class="row">
    <!-- <div  class="col-sm-6 col-md-6"> -->
        <h2>Diseases/ Injuries Suffered by Pets Demographics</h2>
    @if(empty($petdiseasesChart))
       <!--  <div ></div> -->
    @else
          <div>{!! $petdiseasesChart->container() !!}</div>
        {!! $petdiseasesChart->script() !!}
     @endif   
    </div>
</div>
@endsection