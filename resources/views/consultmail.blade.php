<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
</head>
<body>

<div class="flex justify-center pt-8 sm:justify-center sm:pt-200">
	<img src="{{ $message->embed(public_path('/images/others/banner.png')) }}" style="padding:0px; margin:0px" width=500 alt=banner height=100/>
</div>

<p>Hi, </p>
<p>Your pet was successfully consulted on Wonderpet Clinic & Grooming Services! The result of the checkup was written below.</p>

<p>You can visit on <a href="{{url('/')}}">{{url('/')}}</a> for follow-up checkups for your Pet.</p>

<table style="width:100%">
  <tr>
    <td><span>Owner:</span></td>
    <td>{{$data['owner']->name}}</td>
  </tr>
  <tr>
    <td><span>Pet:</span></td>
    <td>{{$data['petname']->name}}</td>
  </tr>
  <tr>
    <td><span>Consulted by:</span></td>
    <td>{{Auth::user()->name}}, DVM</td>
  </tr>
  <tr>
    <td><span>Disease/ Injury:</span></td>
    <td>{{ $data['diseases_injuries'] }}</td>
  </tr>
  <tr>
    <td><span>Observation/ Comment:</span></td>
    <td>{{ $data['comment'] }}</td>
  </tr>
  <tr>
    <td><span>Consultation Cost:</span></td>
    <td>{{ $data['cost'] }}</td>
  </tr>
</table>

<p>Thank You! Best regards!</p>
</body>
</html>

