<!-- <h1>Please activate your account</h1>
<p>
    For Activate Your Account Click Here
    <a href="http://localhost:8000/api/activate/{{$user->email}}/{{$code}}">Activate Account</a>
</p> -->
<html>
<head>
	<meta content="text/html charset=UTF-8" http-equiv="Content-Type" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>রেজিস্ট্রেশনের জন্য ধন্যবাদ</title>
	<style type="text/css">
	/*<![CDATA[*/
	     /* PUT ALL CSS IN THE EMAIL <HEAD>

	These styles are meant for clients that recognize CSS in the <head>; the email WILL STILL WORK for those that don't. */

	     #outlook a {
	       padding: 0;
	     }
	     body {
	       width: 100% !important;
	       background-color: #f4f7fa;
	       -webkit-text-size-adjust: none;
	       -ms-text-size-adjust: none;
	       margin: 0 !important;
	       padding: 0 !important;
	     }
	     .ReadMsgBody {
	       width: 100%;
	     }
	     .ExternalClass {
	       width: 100%;
	     }
	     ol li {
	       margin-bottom: 15px;
	     }

	     img {
	       height: auto;
	       line-height: 100%;
	       outline: none;
	       text-decoration: none;
	     }
	     #backgroundTable {
	       height: 100% !important;
	       margin: 0;
	       padding: 0;
	       width: 100% !important;
	     }

	     p {
	       margin: 1em 0;
	     }

	     h1,
	     h2,
	     h3,
	     h4,
	     h5,
	     h6 {
	       color: #222222 !important;
	       font-family: Arial, Helvetica, sans-serif;
	       line-height: 100% !important;
	     }

	     table td {
	       border-collapse: collapse;
	     }

	     .yshortcuts,
	     .yshortcuts a,
	     .yshortcuts a:link,
	     .yshortcuts a:visited,
	     .yshortcuts a:hover,
	     .yshortcuts a span {
	       color: black;
	       text-decoration: none !important;
	       border-bottom: none !important;
	       background: none !important;
	     }

	     .im {
	       color: black;
	     }
	     div[id="tablewrap"] {
	       width: 100%;
	       max-width: 600px !important;
	     }
	     table[class="fulltable"],
	     td[class="fulltd"] {
	       max-width: 100% !important;
	       width: 100% !important;
	       height: auto !important;
	     }

	     @media screen and (max-device-width: 430px),
	       screen and (max-width: 430px) {
	       td[class="emailcolsplit"] {
	         width: 100% !important;
	         float: left !important;
	         padding-left: 0 !important;
	         max-width: 430px !important;
	       }
	       td[class="emailcolsplit"] img {
	         margin-bottom: 20px !important;
	       }
	     }
	/*]]>*/
	</style>
</head>
<body>
	<table style=" width: 100%;">
		<tr>
			<td></td>
			<td style=" width: 40%; min-width: 580px; text-align: center" valign="top"><a href="#" style="display:inline-block; text-align:center;"><img src="{{url('cv_img/logo.svg')}}" width="170" /></a></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td style=" text-align: center;">
				<table cellpadding="0" cellspacing="0" style="border-collapse: separate; border-radius: 4px; background-color: rgb(255, 255, 255);" width="100%">
					<tr>
						<td height="20"></td>
					</tr>
					<tr style="color: rgb(78, 92, 110); font-size: 14px; line-height: 20px; margin-top: 20px;">
						<td colspan="2" style="padding-left:90px; padding-right:90px; text-align:center" valign="top">
							<!-- BODY START -->
							<table>
								<tr>
									<td>আপনার বিদেশ গমন এখন আরও নিরাপদ । এখানে রয়েছে নিয়োগ বিজ্ঞপ্তি, চাকরিতে আবেদনের সুযোগ, সরকার অনুমোদিত এজেন্সি,প্রশিক্ষণ কেন্দ্র, আর্থিক সংস্থা, গুরুত্বপূর্ণ এম্বাসি, প্রয়োজনীয় ফরমসমূহ আরো আনুষাঙ্গিক অনেক কিছু ।</td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr>
								<tr>
									<td bgcolor="#FFFFFF" style="text-align:center;" width="100%"><a href="http://api.immigration.org.bd/api/activate/{{$user-%3Eemail}}/{{$code}}" style="font-weight:bold; text-decoration:none;"><span style="display:block; max-width:100% !important; width:93% !important; height:auto !important;background-color:rgb(117,171,40);padding-top:15px;padding-right:15px;padding-bottom:15px;padding-left:15px;border-radius:8px;color:#ffffff;font-size:24px;font-family:Arial, Helvetica, sans-serif;">ভেরিফাই ইমেইল</span></a></td>
								</tr>
								<tr>
									<td height="20"></td>
								</tr><!-- <tr>
    <td
      style="margin: 0; color:#a2a2a2; font-size:12px; line-height:17px; font-style:italic;"
    >
      If you did not request submit a request to change your
      password, you may safely ignore this email. The link in
      this email will expire after 24 hours.
    </td>
  </tr> -->
							</table><!-- BODY END -->
						</td>
					</tr>
					<tr>
						<td height="60"></td>
					</tr>
				</table>
			</td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td style=" text-align: center; color:#9EB0C9!important;"><a href="http://immigration.org.bd" style="text-decoration:none;" target="_blank">&copy; অভিবাসী বাতায়ন</a></td>
			<td></td>
		</tr>
	</table>
</body>
</html>