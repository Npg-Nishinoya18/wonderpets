@extends('layouts.base')
@section('content')
<div class="container">
    <h2>Register</h2>
    <form method="post" action="{{route('employee.store')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="lname" class="control-label">Last Name</label>
            <input type="text" class="form-control" id="lname" name="lname"  value="{{old('lname')}}">
            @if($errors->has('lname'))
            <small>{{ $errors->first('lname') }}</small>
            @endif 
        </div>

        <div class="form-group"> 
            <label for="fname" class="control-label">First Name</label>
            <input type="text" class="form-control " id="fname" name="fname" value="{{old('fname')}}">
            @if($errors->has('fname'))
            <small>{{ $errors->first('fname') }}</small>
            @endif 
        </div> 

        <div class="form-group"> 
            <label for="role">Role</label>
            <select name="role" id="role" class="form-select">
                <?php $roles = ['','Admin','Groomer', 'Veterinarian']; ?>
                @foreach($roles as $role)
                <option value={{$role}} {{(old('status') == $role?'selected':'')}} >{{$role}}</option>
                @endforeach
                @if($errors->has('role'))
                <small>{{ $errors->first('role') }}</small>
                @endif 
            </select>
        </div>    

        <div class="form-group"> 
            <label for="email" class="control-label">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
            @if($errors->has('email'))
            <small>{{ $errors->first('email') }}</small>
            @endif 
        </div>
        
        <div class="form-group"> 
            <label for="password" class="control-label">Password</label>
            <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}">
            @if($errors->has('password'))
            <small>{{ $errors->first('password') }}</small>
            @endif 
        </div>

        <div class="form-group">
            <label for="image" class="control-label">Employee Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
        </div>     
    </div>
</form> 
@endsection