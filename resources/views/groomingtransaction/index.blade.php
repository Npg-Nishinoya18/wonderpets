@extends('layouts.master')
@section('title')
 ACME GROOMING SERVICES
@endsection

<style>
.carousel-inner>.item>a>img, .carousel-inner>.item>img, .img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    height: 300px;
}

p {
    margin: 0 0 10px;
    text-align: justify;
}

.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    font-family: inherit;
    font-weight: 1000;
    line-height: 1.1;
    color: black;
    text-align: center;
}

body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-image: url("https://i.pinimg.com/originals/20/5c/21/205c21a8f3cf1fb3eec8b39de2eea603.jpg");
}

</style>

@section('content')
   @foreach ($groomings->chunk(12) as $groomingsChunk)
        <div class="row">
            @foreach ($groomings as $groomingservice)
                <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="{{ asset('/images/groomings/'.$groomingservice->groomings_img) }}" alt="..." class="img-responsive">
                    <div class="caption">
                           <h3><span>{{ $groomingservice->title }}</span></h3><br>
                           <h2><span>${{ $groomingservice->grooming_cost }}</span></h2><br>
                           <br><p>{{ $groomingservice->description }}</p>

                      <div class="clearfix">
                           <a href="{{ route('groomingtransaction.addToCart', ['id'=>$groomingservice->id]) }}" class="btn btn-primary" role="button"><i class="fas fa-cart-plus"></i> Add to Chosen Service</a> 
{{--{{route('comment',$groomingservice->id)}}--}}

                           <a href="{{ route('groomingtransaction.show', ['id'=>$groomingservice->id]) }}" class="btn btn-default pull-right" role="button"><i class="fas fa-info"></i> More Info</a>
                        {{-- {{--   <!--<a href="{{route('comment',$groomingservice->id)}}" class="btn btn-default pull-right" role="button"><i class="fas fa-info"></i> More Info</a>--> --}}
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
    @endforeach
@endsection

