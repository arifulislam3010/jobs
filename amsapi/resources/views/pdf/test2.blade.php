<!DOCTYPE html>
<html>
<head>
  <title>test</title>
  <meta charset="utf-8">
  <!-- <link rel="stylesheet" type="text/css" href="http://api.immigration.orangebd.com/fontawesome/css/all.css"> -->
  <style type="text/css">
    html,
    /*body,.container,.left {
      height: 100%;
    }*/


    body {
      font-family: 'examplefont';
    }
    .container{
      height: 100%;
      width:100%;
    }
    .left{
      width:38%;
      float: left;
      margin-left:2%;
      height: 100%;
      margin-top: -22px;
    }
    .right{
      width:60%;
      float: left;
    }
  </style>
</head>
<body>
  <div class="container">
    @php
      $present_address = json_decode($contact->address3);
      $languages = json_decode($contact->languages);
    @endphp
    <div style="height: 50px;width: 100%;">
      
    </div>
    <div style="height: 60px;width: 100%;background-color: #9942da;">
      <br>
      <span style="color:#fff;font-size: 22px;font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$user->name}}</span>
      <p style="margin-top:10px;"></p>
    </div>
    @if($contact->image != null)
    <img style="height: 160px;width:155px;margin-top: -115px;margin-left: 126px;border: 3px solid #9942da" src="{{$contact->image}}">
    @else
    <img style="height: 160px;width:155px;margin-top: -115px;margin-left: 126px;border: 3px solid #9942da" src="http://api.immigration.orangebd.com/cv_img/blank-face.jpg">
    @endif
    <div class="left">
      <span style="font-size:22px;font-weight: bold">যোগাযোগ</span>
      <div style="width:100%;height: 12px;"></div>
      <div style="width:100%">
        <div>
          <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/pointer.jpg">
        </div>
        @if($present_address)
        <div style="font-size:14px;margin-top: -18px;width: 90%;float:right;">
          <span style="font-size:14px;">{{$present_address->village}}, {{$present_address->postoffice}}, {{$present_address->subdistrict->upazila_name_eng}}, {{$present_address->district->district_name_eng}}</span>
        </div>
        @endif
      </div>
      @if($user->phone)
      <div style="width:100%;height: 10px;"></div>
      <div style="width:100%">
        <div>
          <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/phone.jpg">
        </div>
        <div style="font-size:14px;margin-top: -18px">
          <span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$user->phone}}</span>
        </div>
      </div>
      @endif
      @if($present_address)
      @if($present_address->phone)
      <div style="width:100%;height: 10px;"></div>
      <div style="width:100%">
        <div>
          <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/phone.jpg">
        </div>
        <div style="font-size:14px;margin-top: -18px">
          <span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$present_address->phone}}</span>
        </div>
      </div>
      @endif
      @endif
      @if($user->email)
      <div style="width:100%;height: 10px;"></div>
      <div style="width:100%">
        <div>
          <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/mail.jpg">
        </div>
        <div style="font-size:14px;margin-top: -18px">
          <span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$user->email}}</span>
        </div>
      </div>
      @endif
      <div style="width:100%;height: 20px;"></div>
      <span style="font-size:22px;font-weight: bold">শিক্ষাগত যোগ্যতা</span>
      <div style="width:100%;height: 12px;"></div>
      @if($educations)
      @foreach($educations as $education)
      <div style="width: 100%">
        <div style="width: 80%;float: left">
          <span style="font-size:14px">{{$education->institute}}</span><br>
          <span style="font-size:12px">{{$education->degree_name}}, {{$education->subject}}</span>
        </div>
        <div style="width: 20%;float: left;">
          <span style="font-size:14px">{{$education->passing_year}}</span>
        </div>
      </div>
      <div style="width:100%;height: 10px;"></div>
      @endforeach
      @else
      <div style="width:100%;height: 10px;"></div>
      @endif
      
      @if($total>=3)
      <div style="width:100%;height: 12px;"></div>
      <div style="width:100%">
        <span style="font-size:22px;font-weight: bold">ভাষাগত দক্ষতা </span>
      </div>
      <div style="width:100%;height: 12px;"></div>
      @if($languages)
      @foreach($languages as $language)
      <div style="width: 100%;float: left">
        <span style="font-size:14px">{{$language->language->name}}</span><br>
        <span style="font-size:12px">লিখন দক্ষতা: {{$language->oral_skill}}</span><br>
        <span style="font-size:12px">পঠন দক্ষতা: {{$language->writing_skill}}</span>
      </div>
      <div style="width:100%;height: 10px;"></div>
      @endforeach
      @endif
      @endif
    </div>
    <div class="right">
      <div style="margin:0;width: 100%;">
        <div style="width:92%;margin-left: 8%;">
          <span style="font-size:22px;font-weight: bold">চাকুরীর অভিজ্ঞতা</span>
        </div>
      </div>
      <div style="width:100%;height: 12px;"></div>
      <div style="margin:0;width: 100%;border-left: 2px solid #eef0f2;height: 100%;">
        <div style="width:92%;margin-left: 8%;">
          @if($experiences)
          @foreach($experiences as $experience)
          <div style="width: 100%">
            <div style="width: 78%;float: left">
              <span style="font-size:14px">{{$experience->designation}}</span><br>
              <span style="font-size:14px">{{$experience->company_name}}</span>
            </div>
            <div style="width: 20%;float: left;">
              <span style="font-size:14px">@php echo date("Y", strtotime($experience->start)).' - '.date("Y", strtotime($experience->end))@endphp</span>
            </div>
            <div style="width: 98%;float: left;text-align: justify;">
              @if($experience->responsilbility)
               <div style="height:5px"></div>
               <span style="text-align: justify;font-size:12px">{{$experience->responsilbility}}</span>
              @endif
              @if($experience->responsilbility)
               <div style="height:5px"></div>
               <span style="text-align: justify;font-size:12px;">{{$experience->achievement}}</span>
              @endif
            </div>
          </div>
          <div style="width: 100%">
            
          </div>
          <div style="width:100%;height: 10px;"></div>
          @endforeach
          @else
          <div style="width:100%;height: 10px;"></div>
          @endif
          <div style="width:100%;height: 12px;"></div>
          <div style="width:100%">
            <span style="font-size:22px;font-weight: bold">গৃহীত প্রশিক্ষণ</span>
          </div>
          <div style="width:100%;height: 12px;"></div>

          @if($trainings)
          @foreach($trainings as $training)
          <div style="width: 100%">
            <div style="width: 78%;float: left">
              <span style="font-size:14px">{{$training->training_name}}</span><br>
              <span style="font-size:14px">{{$training->name}}</span>
            </div>
            <div style="width: 20%;float: left;">
              <span style="font-size:14px">{{$training->time_tense}}</span>
            </div>
            <div style="width: 98%;float: left;text-align: justify;">
              @if($training->description)
               <div style="height:5px"></div>
               <span style="text-align: justify;font-size:12px">{{$training->description}}</span>
              @endif
            </div>
          </div>
          <div style="height: 10px;width: 100%"></div>
          @endforeach
          @else
          <div style="height: 10px;width: 100%"></div>
          @endif
          @if($total<=2)
          <div style="height: 12px;width: 100%"></div>
          <div style="width:100%">
            <span style="font-size:22px;font-weight: bold">ভাষাগত দক্ষতা </span>
          </div>
          <div style="width:100%;height: 12px;"></div>
          @if($languages)
          @foreach($languages as $language)
          <div style="width: 100%;float: left">
            <span style="font-size:14px">{{$language->language->name}}</span><br>
            <span style="font-size:12px">লিখন দক্ষতা: {{$language->oral_skill}}</span><br>
            <span style="font-size:12px">পঠন দক্ষতা: {{$language->writing_skill}}</span>
          </div>
          <div style="width:100%;height: 10px;"></div>
          @endforeach
          @endif
          @endif
        </div>
      </div>
    </div>
  </div>
  <!-- <img style="height:100px;width:100px" src="https://www.w3schools.com/howto/img_avatar.png">
  <p style="color:red">Hello world</p> -->
</body>
</html>