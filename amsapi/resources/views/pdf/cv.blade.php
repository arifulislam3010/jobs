<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CV</title>
</head>

<body>
    <div class="main-body">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="job-card-layout">
                        {{-- <div class="cv-top-download-wrapper">
                            <div class="d-flex justify-content-end">
                                <div class="cv-top-button email-btn mr-4">
                                    <a href=""><img src="{{ URL::asset('assets/cv/mail.png') }}"
                                            class="img-fluid" />Email</a>
                                </div>
                                <div class="cv-top-button download-btn">
                                    <a href=""><img src="{{ URL::asset('assets/cv/download-cloud.png') }}"
                                            class="img-fluid" />Download</a>
                                </div>
                            </div>
                        </div> --}}
                        <!-- people info -->
                        <div class="cv-people-info-wrapper">
                            <div class="cv-person-content d-flex mr-5">
                                <div class="cv-person-image">
                                @if($contact->image != null)
                                <img src="{{$contact->image}}" alt="person"
                                        class="img-fluid" />
                                @else
                                <img src="{{ URL::asset('cv_img/img_avatar.png') }}" alt="person"
                                        class="img-fluid" />
                                @endif
                                    
                                </div>
                                <div class="cv-person-details mt-4 pl-4">
                                    <div class="cv-person-name">
                                        <h2>Rezwan Chowdhury Rafel</h2>
                                    </div>
                                    <div class="cv-rating-content-wrapper d-flex align-items-center">
                                        <div class="position-badge">Web Developer</div>
                                        <div class="blood-group-badge">0+ve</div>
                                        <div class="rating">
                                            <ul>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li><i class="fa fa-star"></i></li>
                                                <li class="star-free-block">
                                                    <i class="far fa-star"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="cv-people-contact-info-wrapper">
                                        <ul>
                                            <li>
                                                <img src="{{ URL::asset('assets/cv/phone-call.png') }}"
                                                    alt="" />Contact :
                                                <span>+8801992969618</span>
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset('assets/cv/mailBlack.png') }}" alt="" />Email
                                                :
                                                <span>rafelchy95@gmail.com</span>
                                            </li>
                                            <li>
                                                <img src="{{ URL::asset('assets/cv/map-pin.png') }}" alt="" />Location
                                                :
                                                <span>Mohammadpur</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- experiance -->
                        <div class="experinance-block-wrapper mt-4">
                            <div class="cv-block-header d-flex justify-content-between align-items-center">
                                <div class="cv-block-title">
                                    <h2>Experiance</h2>
                                </div>
                                {{-- <div class="cv-block-edit-btn">
                                    <a href=""><img src="{{ URL::asset('assets/cv/edit.png') }}"
                                            alt="image" />Edit</a>
                                </div> --}}
                            </div>
                            <div class="experiance-main-block-wrapper">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="experiance-single-block">
                                            <div class="experiance-single-block-header">
                                                <h2>Syntech Solutions Ltd.</h2>
                                            </div>
                                            <div class="experiance-single-block-item">
                                                <div>Designation : Web Developer</div>
                                                <div>Joining Date : 1st jan 2016</div>
                                                <div>Resign Date : 1st jan 2016</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="experiance-single-block">
                                            <div class="experiance-single-block-header">
                                                <h2>Syntech Solutions Ltd.</h2>
                                            </div>
                                            <div class="experiance-single-block-item">
                                                <div>Designation : Web Developer</div>
                                                <div>Joining Date : 1st jan 2016</div>
                                                <div>Resign Date : 1st jan 2016</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-lg-4">
                                        <div class="experiance-single-block">
                                            <div class="experiance-single-block-header">
                                                <h2>Syntech Solutions Ltd.</h2>
                                            </div>
                                            <div class="experiance-single-block-item">
                                                <div>Designation : Web Developer</div>
                                                <div>Joining Date : 1st jan 2016</div>
                                                <div>Resign Date : 1st jan 2016</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- education -->
                        <div class="cv-block-header d-flex justify-content-between align-items-center">
                            <div class="cv-block-title">
                                <h2>Education</h2>
                            </div>
                            {{-- <div class="cv-block-edit-btn">
                                <a href=""><img img src="{{ URL::asset('assets/cv/edit.png') }}"
                                        alt="image" />Edit</a>
                            </div> --}}
                        </div>
                        <div class="cv-border-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Secondery School Certificate</h2>
                                        </div>
                                        <div class="cv-single-content-block-content">
                                            <p>
                                                <span>Year: 2011</span><span>Grade:4.7</span>Group :
                                                <span>Science</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Secondery School Certificate</h2>
                                        </div>
                                        <div class="cv-single-content-block-content">
                                            <p>
                                                Year: <span> 2011</span>Grade:<span>4.7</span>Group :
                                                <span>Science</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Secondery School Certificate</h2>
                                        </div>
                                        <div class="cv-single-content-block-content">
                                            <p>
                                                <span>Year: 2011</span><span>Grade:4.7</span>Group :
                                                <span>Science</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <!-- training block -->
                        <div class="cv-block-header d-flex justify-content-between align-items-center">
                            <div class="cv-block-title">
                                <h2>Training</h2>
                            </div>
                            {{-- <div class="cv-block-edit-btn">
                                <a href=""><img img src="{{ URL::asset('assets/cv/edit.png') }}"
                                        alt="image" />Edit</a>
                            </div> --}}
                        </div>
                        <div class="cv-border-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Web Development (PHP & Laravel)</h2>
                                        </div>
                                        <div class="cv-single-content-block-content">
                                            <p>
                                                <span>Duration : 1 Year</span><span>Institute : BIIST</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Secondery School Certificate</h2>
                                        </div>
                                        <div class="cv-single-content-block-content">
                                            <p>
                                                <span>Web & Graphics Design</span><span>Institute : Institute of Arts
                                                    and Culture</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- personal info -->
                        <div class=" cv-block-header d-flex justify-content-between align-items-center">
                            <div class="cv-block-title border-right">
                                <h2>Personal Info</h2>
                            </div>
                            {{-- <div class="cv-block-edit-btn">
                                <a href=""><img img src="{{ URL::asset('assets/cv/edit.png') }}"
                                        alt="image" />Edit</a>
                            </div> --}}
                        </div>
                        <div class="cv-border-block">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="cv-single-content-block">
                                        <div class="personal-info cv-single-content-block-content">
                                            <table>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>: Rezwan Chowdhury Rafel</td>
                                                </tr>
                                                <tr>
                                                    <td>Fathers Name</td>
                                                    <td>: Rashe Chowdhury</td>
                                                </tr>
                                                <tr>
                                                    <td>Mothers Name</td>
                                                    <td>: Farida Begum</td>
                                                </tr>
                                                <tr>
                                                    <td>Birth Date</td>
                                                    <td>: 8th Jan 2021</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td>: Male</td>
                                                </tr>
                                                <tr>
                                                    <td>NID Number</td>
                                                    <td>: 32227489212</td>
                                                </tr>
                                                <tr>
                                                    <td>Nationality</td>
                                                    <td>: Bangladeshi</td>
                                                </tr>
                                                <tr>
                                                    <td>Relegious</td>
                                                    <td>: Islam</td>
                                                </tr>
                                                <tr>
                                                    <td>Maretial Status</td>
                                                    <td>: Unmarried</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="cv-single-content-block">
                                        <div class="personal-info cv-single-content-block-content">
                                            <table>
                                                <tr>
                                                    <td>Passport No.</td>
                                                    <td>: 7836490220</td>
                                                </tr>
                                                <tr>
                                                    <td>Passport Issue Date.</td>
                                                    <td>: 6th May 2012</td>
                                                </tr>
                                                <tr>
                                                    <td>Expected Indusry</td>
                                                    <td>: IT and Telecommunications</td>
                                                </tr>
                                                <tr>
                                                    <td>Expected Country</td>
                                                    <td>: Bangladesh</td>
                                                </tr>
                                                <tr>
                                                    <td>Prefession</td>
                                                    <td>: 72KG</td>
                                                </tr>
                                                <tr>
                                                    <td>NID Number</td>
                                                    <td>: 32227489212</td>
                                                </tr>
                                                <tr>
                                                    <td>Nationality</td>
                                                    <td>: Bangladeshi</td>
                                                </tr>
                                                <tr>
                                                    <td>Relegious</td>
                                                    <td>: Islam</td>
                                                </tr>
                                                <tr>
                                                    <td>Maretial Status</td>
                                                    <td>: Unmarried</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- address -->
                        <div class="cv-block-header d-flex justify-content-between align-items-center">
                            <div class="cv-block-title">
                                <h2>Address</h2>
                            </div>
                            {{-- <div class="cv-block-edit-btn">
                                <a href=""><img img src="{{ URL::asset('assets/cv/edit.png') }}"
                                        alt="image" />Edit</a>
                            </div> --}}
                        </div>
                        <div class="address-block cv-border-block">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Present Address</h2>
                                        </div>
                                        <div class="addressInfo cv-single-content-block-content">
                                            <p>State <span>: Dhaka</span></p>
                                            <p>Distrcit <span>: Dhaka</span></p>
                                            <p>Thana <span>: New Market</span></p>
                                            <p>Area/Village <span>: Katabon</span></p>
                                            <p>House/Road <span>: 256</span></p>
                                            <p>Post Code <span>: 1205</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="cv-single-content-block">
                                        <div class="cv-single-content-block-title">
                                            <h2>Permanent Address</h2>
                                        </div>
                                        <div class="addressInfo  cv-single-content-block-content">
                                            <p>State <span>: Dhaka</span></p>
                                            <p>Distrcit <span>: Dhaka</span></p>
                                            <p>Thana <span>: New Market</span></p>
                                            <p>Area/Village <span>: Katabon</span></p>
                                            <p>House/Road <span>: 256</span></p>
                                            <p>Post Code <span>: 1205</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- copyright footer -->
                        <div class="cv-footer-wrapper mt-1">
                            <div class="cv-footer-content-wrapper d-flex justify-content-between align-items-center">
                                <div class="cv-copyright">
                                    <p>Powered by <a href="">Mechanic chai</a></p>
                                </div>
                                <div class="cv-signature">
                                    <div class="cv-border">
                                        Signature
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
