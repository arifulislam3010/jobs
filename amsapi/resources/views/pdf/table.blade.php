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
@if($post)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 5px;">
    <span style="font-size: 16px;">বিজ্ঞপ্তি: {{$post->headline}}</span>
  </div>
</div>
@endif
@if($status == 1)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">পেন্ডিং প্রার্থী তালিকা</span>
  </div>
</div>
@elseif($status == 2)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">সর্ট প্রার্থী তালিকা</span>
  </div>
</div>
@elseif($status == 3)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">সিলেক্ট প্রার্থী তালিকা</span>
  </div>
</div>
@elseif($status == 4)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">মাইগ্রেট প্রার্থী তালিকা</span>
  </div>
</div>
@elseif($status == 10)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">রিজেক্ট প্রার্থী তালিকা</span>
  </div>
</div>
@elseif($status == 111)
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">প্রার্থী তালিকা</span>
  </div>
</div>
@else
<div style="width: 100%">
  <div style="text-align: center;margin-bottom: 30px;">
    <span style="border-bottom: 2px solid #000;font-size: 20px;font-weight: bold">প্রার্থী তালিকা</span>
  </div>
</div>
@endif
<table style="width:100%">
  <tr>
    <th>ক্রমিক নং</th>
    <th>নাম</th>
    <th>ইমেইল</th> 
    <th>ফোন</th>
  </tr>
  @foreach($data as $key => $applicant)
  <tr>
    <td style="font-family: 'examplefont'">&nbsp;{{$key+1}}</td>
    <td>&nbsp;{{$applicant->name}}</td>
    <td>&nbsp;{{$applicant->email}}</td>
    <td>&nbsp;{{$applicant->phone}}</td>
  </tr>
  @endforeach
</table>
<div style="width: 100%;margin-top: 10px;">
  <div style="margin-top: 40px;margin-left: 60%;">
    <div>
      @if($subdistrict)
      <span>{{$subdistrict->subdistrict}}</span><br>
      <span>{{$designation->designation}}</span><br>
      @endif
      @if($district)
      <span>{{$district->district}}</span><br>
      <span>{{$designation->designation}}</span><br>
      @endif
      <span>{{$user}}</span><br>
      <span>স্বাক্ষর:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </div>
  </div>
</div>
</body>
</html>