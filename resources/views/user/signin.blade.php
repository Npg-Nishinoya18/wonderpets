@extends('layouts.base')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>{{ __('Sign In') }}</strong></div>
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-block">
             <button type="button" class="close" data-dismiss="alert">×</button> 
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</strong>
                    @endforeach
                </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
             <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
            </div>
            @endif

            <form class="" action="{{ route('user.signin') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" class="form-control">
                    <!-- @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror -->
                </div>

                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                    <input type="submit" value="Sign In" class="btn btn-primary">
             </form>
            </div>
        </div>
    </div>
</div>
@endsection     