@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Grooming Services</h3>
        
        <a href="{{ route('getGroomings') }}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-plus"></i><strong> GROOMING SERVICE DATA TABLE</strong></span>            
        </a>

        <a href="{{route('getgroomtrans')}}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-search"></i><strong> SEARCH CUSTOMER'S TRANSACTION</strong></span>            
        </a>

        <a href="{{ route('transaction.transactionlist') }}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        <span><i class="fa fa-file-alt"></i><strong> GROOMING SERVICES LISTS</strong></span>            
        </a>

@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Grooming Service Image</th>
                <th>Grooming Service ID</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Service Cost</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groomings as $grooming)
            <tr>
                <td><a href="{{route('grooming.show',$grooming->id)}}">{{$grooming->id}}</a></td>
                <td>{{$grooming->title}}</td>
                <td>{{$grooming->description}}</td>
                <td>{{$grooming->grooming_cost}}</td>
                @if($grooming->deleted_at)
            <td><a href="" class="btn btn-warning">Edit</a></td>
          @else
            <td><a href="{{ action('GroomingController@edit', $grooming->id)}}" class="btn btn-warning">Edit</a></td>
          @endif
          @if($grooming->deleted_at)
          <td><button class="btn btn-danger" type="submit" disabled>Delete</button></td>
          @else
          <td>
            {!! Form::open(array('route' => array('grooming.destroy', $grooming->id),'method'=>'DELETE')) !!}
          <button class="btn btn-danger" type="submit">Delete</button>
            {!! Form::close() !!}
          </td>
          @endif
          <td>
          @if(!$grooming->deleted_at) 
          <!-- if not dapat -->
            <td><button class="btn btn-primary" type="submit" disabled>Restore</button></td>
          @else
            <td><a href="{{ action('GroomingController@restore', $grooming->id)}}" class="btn btn-primary">Restore</a></td>
          @endif
         </td>
                
            </tr>
            @endforeach
            </table>
        <div>{{$groomings->links()}}</div>
</div>
@endsection