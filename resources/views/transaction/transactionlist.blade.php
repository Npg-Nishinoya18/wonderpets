@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>Grooming Service Transaction List</h3>

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
                <th>Service ID</th>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Pet's Name</th>
                <th>Service Cost</th>
                <th>Service Name</th>
                <th>Status</th>
                <th>Date Serviced</th>
                <th>Update Status</th>
                <!-- <th>Cancel Service</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach($transactionlist as $transactionlists)
            <tr>
                <td>{{$transactionlists->serviceID}}</td>
                <td>{{$transactionlists->userID}}</td>
                <td>{{$transactionlists->userName}}</td>
                <td>{{$transactionlists->petname}}</td>
                <td>{{$transactionlists->gsCost}}</td>
                <td>{{$transactionlists->gsTitle}}</td>
                <td>{{$transactionlists->status}}</td>
                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($transactionlists->dateServiced))->format('F d, Y')}}</td>
                <td align="center">

                <form action="{{url('/update/'.$transactionlists->serviceID)}}" method="GET" class="forms">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <select name="status" id="type" class="form-select">
                      <?php $statuss = ['Pending','FullyPaid', 'Cancelled']; ?>
                      @foreach($statuss as $status)
                        <option value={{$status}} {{(old('status') == $status?'selected':'')}} >{{$status}}</option>
                      @endforeach
                      @if($errors->has('status'))
                        <small>{{ $errors->first('status') }}</small>
                      @endif 
                    </select>
                    <!--<a href="{{url('/update/'.$transactionlists->serviceID)}}" class="btn btn-primary btn-sm">Paid</a>-->
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
                <!-- </td>

                {!! Form::open(array('route' => array('transaction.destroy', $transactionlists->serviceID),
                    'method'=>'DELETE')) !!} 
                    <td align="center"><button><i class="fa-solid fa-trash-can" style="font-size:24px; color:red"></i></button></td>
                {!! Form::close() !!}  -->
                
            </tr>
            @endforeach
            </table>
</div>
@endsection