@extends('layouts.base')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

        <!-- PetDiseases Dashboard -->
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
            
            <br>

            <hr style="width:100%", size="6", color=black>  
        <!-- Pet Groomed Dashboard -->
        <div class="row">
            <!-- <div  class="col-sm-6 col-md-6"> -->
                <h2>Number of Pets Groomed</h2>

                
                @if(empty($petgroomedChart))
                <!--  <div ></div> -->
                @else
                <div>{!! $petgroomedChart->container() !!}</div>
                {!! $petgroomedChart->script() !!}
                @endif 
            <div style="display: inline;" align="center">
                <form method="post" action="{{route('searchhome')}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card-body">
                    <label for = "Date">Start Date</label>
                    <input  type="date" id="startDate" name = "startDate">
                
                    <label for = "Date">End Date</label>
                    <input  type="date" id="endDate" name = "endDate">
                </div>
                <div class = "card-body">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{route('home')}}" class="btn btn-default" role="button">Refresh</a>
                </div>
            </form>
        </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection