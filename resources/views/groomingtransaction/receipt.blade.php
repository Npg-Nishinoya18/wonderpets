@extends('layouts.base')
@section('content')

    <title>ACME Pet Grooming and Services</title>
    <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet">

<div class = "cart-view-table-back">
        <div class="buttons">
 
        </div>
        <table width="100%"  cellpadding="6" cellspacing="0">
            <br>
        
        <img src='../images/others/banner.png' class='center' width=680 alt=banner height=150 />
        <h3><span>ACME Pet Shop</span></h3>
        <h5>Receipt for Grooming Transaction</h5>
        <h6>"Hope you have a great experience! Thank you!"</h6>
        <p>-------------------------------------------------------------------------------------------------------------------------------------------------</p>
        @foreach($receipts->unique('serviceID','date_Serviced', 'cusID', 'cusfname', 'cuslname') as $receiptssss)
        <p><h4>Service Details</h4></p>
        <p><strong>Service ID: </strong>{{$receiptssss->serviceID}}</p>
        <p><strong>Service Date: </strong>{{ \Carbon\Carbon::createFromTimestamp(strtotime($receiptssss->date_Serviced))->format('F d, Y')}}</p>
        <br>

        <p><h4>Customer Details</h4></p>
        <p><strong>Customer ID: </strong>{{$receiptssss->cusID}}</p>
        <p><strong>Customer Name: </strong>{{$receiptssss->userName}}</p>
        <br>
        @endforeach
        <p>-------------------------------------------------------------------------------------------------------------------------------------------------</p>
        <h4>Pet Details with Grooming Service</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th style="text-align:center">Pet Name</th>
                <th style="text-align:center">Grooming Service</th>
                <th style="text-align:center">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                @foreach($receipts as $receiptss)
                    <td align = "center">{{$receiptss->petname}}</td>
                    <td align = "center">{{$receiptss->gsTitle}}</td>
                    <td align = "center">{{$receiptss->gsCost}}</td>
                </tr>
                @endforeach

                @foreach($total as $totals)
               <tr><td colspan="5"><span style="float:right;text-align: right;"><strong>Amount Payable: </strong>{{$totals->Total.'.00'}}</span></td></tr>
               @endforeach
            </tbody>
        </table> 
        <br>
    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print Receipt</button>
</table>    
</div>
@endsection