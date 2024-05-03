@extends('layouts.app')

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

                    <h2>{{ __('You are logged in as ') }}{{Auth::user()->role.', '}}<span>{{Auth::user()->name.'!'}}</span></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-md-offset-12">
        <h1>USER'S PROFILE</h1>
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
    </div>


        {{-- <h3>Pets</h3>
        <a href="{{route('consultation.create')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-kit-medical"></i><strong> Add Consultation</strong></span>  
        </a>          
        <form method="GET" action="{{url('search')}}" > --}}
            {{-- <div class="container"> --}}
                 {{-- <label for="genre">Search</label>
                 <input type="text" class="form-control" name="search" id="genre"> --}}
         {{-- </div> --}}
          {{-- </form> --}}
{{-- @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>

@endif --}}
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Pet Image</th>
                <th>Pet ID</th>
                <th>Pet Name</th>
                <th>Type</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td><img src="{{ asset('/images/pet/'.$pet->pet_img) }}" width="200" height="200"/></td>
                <td>{{$pet->id}}</td>
                <td>{{$pet->name}}</td>
                <td>{{$pet->type}}</td>
                @if($pet->deleted_at)
                <td><a href="" class="btn btn-warning">Edit</a></td>
              @else
                <td><a href="{{ route('petss.edit', $pet->id)}}" class="btn btn-warning">Edit</a></td>
              @endif
              @if($pet->deleted_at)
              <td><button class="btn btn-danger" type="submit" disabled>Delete</button></td>
              @else
              <td>
                {!! Form::open(array('route' => array('grooming.destroy', $pet->id),'method'=>'DELETE')) !!}
              <button class="btn btn-danger" type="submit">Delete</button>
                {!! Form::close() !!}
              </td>
              @endif
              <td>
              {{-- @if(!$pet->deleted_at) 
              <!-- if not dapat -->
                <td><button class="btn btn-primary" type="submit" disabled>Restore</button></td>
              @else
                <td><a href="{{ action('GroomingController@restore', $grooming->id)}}" class="btn btn-primary">Restore</a></td>
              @endif --}}
             </td>
                    
                </tr>
                @endforeach
                </table>
        </div>

    <a href="{{url()->previous()}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-house"></i><strong> Return to Home </strong></span>  
    </a>

    <a href="{{route('customer.edit', Auth::user()->id)}}" class="btn btn-warning a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-edit"></i><strong> Edit Profile </strong></span>  
    </a>

    <a href="{{route('pets.create', Auth::user()->id)}}" class="btn btn-success a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-edit"></i><strong> Add New Pet</strong></span>  
    </a>
</div>
</div>
@endsection