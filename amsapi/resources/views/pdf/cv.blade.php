<!DOCTYPE html>
<html>
<head>
<title>CV</title>
<meta charset="UTF-8"> 

<!-- <link type="text/css" rel="stylesheet" href="style.css"> -->
<style type="text/css">
	html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video {
border:0;
font:inherit;
font-size:100%;
margin:0;
padding:0;
vertical-align:baseline;
}

article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section {
display:block;
}

html, body { font-family: 'examplefont'; font-size: 16px;width:100%;background: #f3f3f3;text-align: justify;}

.clear {clear: both;}

p {
	font-size: 1em;
	line-height: 1.4em;
	margin-bottom: 20px;
	color: #444;
}

#cv {
	width: 100%;
	background: #f3f3f3;
}

.mainDetails {
	padding: 25px 35px;
	border-bottom: 2px solid #cf8a05;
	width:100%;
	/*background: #ededed;*/
}

#name h1 {
	font-size: 2.5em;
	font-weight: 700;
	font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
	margin-bottom: -6px;
}

#name h2 {
	font-size: 2em;
	margin-left: 2px;
	font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
}

#mainArea {
	padding: 0 40px;
}

#headshot {
	width: 17%;
	float: left;
}

#headshot img {
	width: 100%;
	height: auto;
	-webkit-border-radius: 50px;
	border-radius: 50px;
}

#name {
	width: 40%;
	float: left;
	margin-left: 20px;
}

#contactDetails {
	width: calc(80% - 30px);
	float: left;
	margin-left: 22px;
}
#contactDetails p {
	font-size: 2em;
	/*font-weight: 700;*/
	font-family: 'examplefont';
	margin-bottom: -6px;
}

#contactDetails ul {
	list-style-type: none;
	font-size: 0.9em;
	margin-top: 2px;
}

#contactDetails ul li {
	margin-bottom: 3px;
	color: #444;
}

#contactDetails ul li a, a[href^=tel] {
	color: #444; 
	text-decoration: none;
	-webkit-transition: all .3s ease-in;
	-moz-transition: all .3s ease-in;
	-o-transition: all .3s ease-in;
	-ms-transition: all .3s ease-in;
	transition: all .3s ease-in;
}

#contactDetails ul li a:hover { 
	color: #cf8a05;
}


section {
	border-top: 1px solid #dedede;
	padding: 20px 0 0;
}

section:first-child {
	border-top: 0;
}

section:last-child {
	padding: 20px 0 10px;
}

.sectionTitle {
	float: left;
	width: 25%;
}

.sectionContent {
	float: right;
	width: 72.5%;
}

.sectionTitle h1 {
	font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
	font-style: italic;
	font-size: 1.5em;
	color: #cf8a05;
}

.sectionContent h2 {
	font-family: 'Rokkitt', Helvetica, Arial, sans-serif;
	font-size: 1.5em;
	margin-bottom: -2px;
}

.subDetails {
	font-size: 0.8em;
	font-style: italic;
	margin-bottom: 5px;
}

.subDetails2 {
	font-size: 1em;
	margin-bottom: 3px;
}

.keySkills {
	list-style-type: none;
	-moz-column-count:3;
	-webkit-column-count:3;
	column-count:3;
	margin-bottom: 20px;
	font-size: 1em;
	color: #444;
}

.keySkills ul li {
	margin-bottom: 3px;
}

.address {
	width:40%;
	float:left;
	list-style-type: none;
	-moz-column-count:3;
	-webkit-column-count:3;
	column-count:3;
	margin-bottom: 20px;
	font-size: 1em;
	color: #444;
}

.address ul li {
	margin-bottom: 3px;
}

</style>
<!-- <link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'> -->

<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body id="top">
<div id="cv" class="instaFade">
	<div class="mainDetails">
		<div id="headshot">
			<img  src="https://www.w3schools.com/howto/img_avatar.png" alt="Alan Smith" />
		</div>
		
		<!-- <div id="name">
			<h1 class="quickFade delayTwo">Joe Bloggs</h1>
			<h2 class="quickFade delayThree">Job Title</h2>
		</div> -->
		
		<div id="contactDetails">
			<p>{{$user->name}}</p>
			<ul>
				@if($user->email)
				<li>ইমেইল: {{$user->email}}</li>
				@endif
				@if($user->phone)
				<li>মোবাইল: {{$user->phone}}</li>
				@endif
				<li>এনআইডি: {{$contact->nid}}</li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	
	<div id="mainArea" class="quickFade delayFive">
		<section>
			<article>
				<div class="sectionTitle">
					<h1>স্থায়ী ঠিকানা</h1>
				</div>
				
				<div class="sectionContent">
					@php
						$permanent_address = json_decode($contact->address2);
						$languages = json_decode($contact->languages);
					@endphp
					<ul class="address">
						<li><b>বিভাগ:</b> {{$permanent_address->division->division_name_eng}}</li>
						<li><b>জেলা:</b> {{$permanent_address->district->district_name_eng}}</li>
						<li><b>উপজেলা: </b>{{$permanent_address->subdistrict->upazila_name_eng}}</li>
						<li><b>ইউনিয়ন: </b>{{$permanent_address->union->union_name_eng}}</li>
					</ul>
					<ul class="address">
						<li><b>গ্রাম/ মহল্লা: </b>{{$permanent_address->village}}</li>
						<li><b>রাস্তার নাম: </b>{{$permanent_address->street}}</li>
						<li><b>পোস্ট অফিস: </b>{{$permanent_address->postoffice}}</li>
						<li><b>ফোন: </b>{{$permanent_address->phone}}</li>
					</ul>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		<section>
			<article>
				<div class="sectionTitle">
					<h1>বর্তমান ঠিকানা</h1>
				</div>
				
				<div class="sectionContent">
					@php
						$present_address = json_decode($contact->address3);
					@endphp
					<ul class="address">
						<li><b>বিভাগ:</b> {{$present_address->division->division_name_eng}}</li>
						<li><b>জেলা:</b> {{$present_address->district->district_name_eng}}</li>
						<li><b>উপজেলা: </b>{{$present_address->subdistrict->upazila_name_eng}}</li>
						<li><b>ইউনিয়ন: </b>{{$present_address->union->union_name_eng}}</li>
					</ul>
					<ul class="address">
						<li><b>গ্রাম/ মহল্লা: </b>{{$present_address->village}}</li>
						<li><b>রাস্তার নাম: </b>{{$present_address->street}}</li>
						<li><b>পোস্ট অফিস: </b>{{$present_address->postoffice}}</li>
						<li><b>ফোন: </b>{{$present_address->phone}}</li>
					</ul>
				</div>
			</article>
			<div class="clear"></div>
		</section>
		<section>
			<div class="sectionTitle">
				<h1>চাকুরীর অভিজ্ঞতা</h1>
			</div>
			
			<div class="sectionContent">
 
				@foreach($experiences as $experience)
				<article>
					<h2>{{$experience->designation}}, {{$experience->company_name}}</h2>
					<p class="subDetails">@php echo date("d-m-Y", strtotime($experience->start)).'  --  '.date("d-m-Y", strtotime($experience->end))@endphp</p>

					@if($experience->responsilbility)
					<p style="margin-bottom:5px;">{{$experience->responsilbility}}</p>
					@endif

					@if($experience->achievement)
					<p>{{$experience->achievement}}</p>
					@endif
				</article>
				@endforeach
			</div>
			<div class="clear"></div>
		</section>

		<section>
			<div class="sectionTitle">
				<h1>গৃহীত প্রশিক্ষণ</h1>
			</div>
			
			<div class="sectionContent">
 
				@foreach($trainings as $training)
				<article>
					<h2>{{$training->training_name}}, {{$training->name}}</h2>
					<p class="subDetails">{{$training->time_tense}}</p>

					@if($training->description)
					<p style="margin-bottom:5px;">{{$training->description}}</p>
					@endif
				</article>
				@endforeach
			</div>
			<div class="clear"></div>
		</section>
		
		<!-- <section>
			<div class="sectionTitle">
				<h1>কাঙ্খিত চাকুরী</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="address">
					@foreach($jobs as $key => $job)
					@if($key%2 == 0)
						<li>{{$job->name}}</li>
					@endif
					@endforeach
				</ul>
				<ul class="address">
					@foreach($jobs as $key => $job)
					@if($key%2 == 1)
						<li>{{$job->name}}</li>
					@endif
					@endforeach
				</ul>
			</div>
			<div class="clear"></div>
		</section>
		<section>
			<div class="sectionTitle">
				<h1>কাঙ্খিত দেশ</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="address">
					@foreach($countries as $key => $country)
					@if($key%2 == 0)
						<li>{{$country->country_name}}</li>
					@endif
					@endforeach
				</ul>
				<ul class="address">
					@foreach($countries as $key => $country)
					@if($key%2 == 1)
						<li>{{$country->country_name}}</li>
					@endif
					@endforeach
				</ul>
			</div>
			<div class="clear"></div>
		</section> -->
		<!-- <section>
			<div class="sectionTitle">
				<h1>Key Skills</h1>
			</div>
			
			<div class="sectionContent">
				<ul class="keySkills">
					<li>A Key Skill</li>
					<li>A Key Skill</li>
					<li>A Key Skill</li>
					<li>A Key Skill</li>
					<li>A Key Skill</li>
					<li>A Key Skill</li>
					<li>A Key Skill</li>
					<li>A Key Skill</li>
				</ul>
				
			</div>
			<div class="clear"></div>
		</section> -->

		<section>
			<div class="sectionTitle">
				<h1>শিক্ষাগত যোগ্যতা</h1>
			</div>
			
			<div class="sectionContent">
				@foreach($educations as $education)
				<article>
					<h2>{{$education->institute}}</h2>
					<p class="subDetails">{{$education->degree_name}}</p>
					<p class="subDetails2">বিষয়: {{$education->subject}}</p>
					<p class="subDetails2">গ্রেড/ডিভিশান: {{$education->grade}}</p>
					<p class="subDetails2">পাশের সন: {{$education->passing_year}}</p>
				</article>
				@endforeach
			</div>
			<div class="clear"></div>
		</section>
		<section>
			<div class="sectionTitle">
				<h1>ভাষাগত দক্ষতা</h1>
			</div>
			
			<div class="sectionContent">
				@foreach($languages as $language)
				<article>
					<h2>{{$language->language->name}}</h2>
					<p class="subDetails2">মৌখিক দক্ষতা: {{$language->oral_skill}}</p>
					<p class="subDetails2">লেখার দক্ষতা: {{$language->writing_skill}}</p>
				</article>
				@endforeach
			</div>
			<div class="clear"></div>
		</section>
	</div>
</div>

</body>
</html>