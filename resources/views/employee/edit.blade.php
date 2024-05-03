@extends('layouts.base')
@section('body')
<div class="container">
    <h2>Edit Employee</h2>
    {{ Form::model($employee,['route' => ['employee.update',$employee->id],'method'=>'PUT', 'enctype'=>'multipart/form-data']) }}

    <div class="form-group"> 
        <label for="name" class="control-label">Name</label>
        {{ Form::text('name',null,array('class'=>'form-control','id'=>'name', 'disabled')) }}
        @if($errors->has('name'))
        <small>{{ $errors->first('name') }}</small>
        @endif 
    </div> 

    <div class="form-group"> 
        <label for="role">Role</label>
        <select name="role" id="role" class="form-select">
            <?php $roles = ['','Admin','Veterinarian', 'Groomer']; ?>
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
        {{ Form::text('email',null,array('class'=>'form-control','id'=>'email', 'disabled')) }}
        @if($errors->has('email'))
        <small>{{ $errors->first('email') }}</small>
        @endif 
    </div>

    <div class="form-group"> 
        <label for="password" class="control-label">Password</label>
        {{ Form::text('password',null,array('class'=>'form-control','id'=>'password', 'disabled')) }}
        @if($errors->has('password'))
        <small>{{ $errors->first('password') }}</small>
        @endif 
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
</div>     
</div>
{!! Form::close() !!} 
@endsection