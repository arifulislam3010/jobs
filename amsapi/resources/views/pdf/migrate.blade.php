<!DOCTYPE html>
<html>
<head>
<title>Mechanicchai</title>
<style>
table, th, td {
  font-family: 'examplefont';
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <img style="height:60px;width:60px;" src="https://mechanicchai.com/img/logo.png"><br>
    <span>Mechanicchai job</span><br>
    <span><a href="https://job.mechanicchai.com/">https://job.mechanicchai.com/</a></span>
  </div>
</div>
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">নির্বাচিত প্রার্থী তালিকা</span>
  </div>
</div> 
<table style="width:100%">
  <tr>
    <th>প্রার্থী</th>
    <th>পদবি</th> 
    <th>এজেন্সি</th>
  </tr>
  @foreach($data as $applicant)
  <tr>
    <td>{{$applicant->applicant_name}}</td>
    <td>{{$applicant->post_name}}</td>
    <td>{{$applicant->agency_name}}</td>
  </tr>
  @endforeach
</table>
<div style="width: 100%;margin-top: 50px;">
  <div style="margin-left:60%;">
    <span>নাম: {{$user}}</span><br>
    <span>স্বাক্ষর:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  </div>
</div>
</body>
</html>