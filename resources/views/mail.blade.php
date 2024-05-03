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
<p>You have successfully completed Customer Registration on Wonderpet Clinic & Grooming Services! </p>

<p>You can visit on <a href="{{url('/')}}">{{url('/')}}</a></p>

<table style="width:100%">
  <tr>
    <td>Name:</td>
    <td>{{$name}}</td>
  </tr>
  <tr>
    <td>Role:</td>
    <td>{{$role}}</td>
  </tr>
  <tr>
    <td>Phone:</td>
    <td>{{$phone}}</td>
  </tr>
  <tr>
    <td>Email:</td>
    <td>{{$email}}</td>
  </tr>
</table>

<p>Thank You!</p>
</body>
</html>

