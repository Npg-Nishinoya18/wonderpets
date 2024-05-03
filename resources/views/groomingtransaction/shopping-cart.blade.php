<!-- //views/shop/shopping.blade.php -->
@extends('layouts.master')
@section('title')
CHOSEN GROOMING SERVICE
@endsection
<link href="{{ URL::asset('css/selectbox.css') }}" rel="stylesheet">
<style>
.container{
    background-color: darkseagreen;
    padding-top: 20px;
    padding-bottom: 20px;
    width: 500px;
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
<b><p>CHOSEN GROOMING SERVICE</p></b>
@if(Session::has('cart'))
    <div style="display: inline;" align="center">
        <div class="select"> 
            <label for="user_id">Groomer's Name:</label>
                <select name="user_id" id="user_id" class="form-select">
                    @foreach($user as $users)
                        @if($users->role == 'Groomer')
                            <option value="{{$users->id}}">
                                {{$users->name}}
                            </option>
                        @endif
                    @endforeach
                </select>
        </div>
    </div>
    <br>

<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <ul class="list-group">
            @foreach($groomings as $groomings)
            <li class="list-group-item">
                <!-- <span class="badge">{{ $groomings['qty'] }}</span> -->
                <strong>{{ $groomings['groomings']['title'] }}</strong>
                <p>{{ $groomings['groomings']['description'] }}</p>

           <form action="{{ route('checkout') }}" method="GET" class="forms">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                 <div class="select"> 
                    <label for="pet_id">Pet to be Service:</label>
                    <select name="pet_id[{{ $groomings['groomings']['id'] }}]" id="pet_id[{{ $groomings['groomings']['id'] }}]" class="form-select">
                    @foreach($pets as $pet)
                    @if($pet->userID == Auth::user()->id)
                      <option value="{{$pet->id}}">{{$pet->name}}</option>
                    @endif
                    @endforeach
                    </select>
                </div>
            <!--</form>-->

                <span class="label label-success">{{ $groomings['price'] }}</span>
               <!-- <span class="label label-success">{{ $groomings['groomings']['name'] }}</span> -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-xs dropdown-toogle" data-toggle="dropdown">Action <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('groomingtransaction.remove',['id'=>$groomings['groomings']['id']]) }}">Remove</a></li>
                    </ul>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <strong>Total: {{ $totalPrice }}</strong>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
       <!--  {{-- <a href="{{ route('checkout') }}" type="button" class="btn btn-primary">Checkout</a> --}} -->
        <button type="submit" class="btn btn-primary">Checkout</button>
    </div>
</div>
</form>
@else
<div class="row">
    <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
        <h2>No Chosen Service in Cart!</h2>
    </div>
</div>
@endif
@endsection