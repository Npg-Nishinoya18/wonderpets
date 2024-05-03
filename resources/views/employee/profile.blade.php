@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Notice') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>{{ __('You are logged in as ') }}{{Auth::user()->role.', '}}<span>{{Auth::user()->name.'!'}}</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-md-offset-12">
        <h1><strong>EMPLOYEE'S PROFILE</strong></h1>
        <td><img src="{{ asset('/images/user/'.Auth::user()->user_img) }}" width="200" height="200" border= "5px solid #555"/></td>
        <div class="form-group mb-3">
            <label for=""><strong>Name: </strong></label>
            <td>{{Auth::user()->name}}</td>
        </div>

        <div class="form-group mb-3">
            <label for=""><strong>Role: </strong></label>
            <td>{{Auth::user()->role}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>E-mail: </strong></label>
            <td>{{Auth::user()->email}}</td>
        </div>
        <div class="form-group mb-3">
            <label for=""><strong>Password: </strong></label>
            <td>{{Auth::user()->password}}</td>
        </div>

    <a href="{{route('home')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Home</strong></span>  
    </a>

    <?php if(Auth::user()->role == 'Admin'): ?>
    <a href="{{route('employee.edit', Auth::user()->id)}}" class="btn btn-warning a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-edit"></i><strong> Edit Profile </strong></span>  
    </a>
    <?php endif; ?>
    </div>
</div>
@endsection
