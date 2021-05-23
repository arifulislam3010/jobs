<template>
     <div style="padding-top:0px;"  class="section ">
        <!-- User Information -->
        <!-- <section class="text-center">
        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
            <div class="fileinput-new thumbnail img-circle img-raised">
            <img src="../../assets/argon/img/placeholder.jpg" alt="...">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
            <div>
            <span class="btn btn-raised btn-round btn-primary btn-file btn-sm mx-auto mt-3">
                <span class="fileinput-new">Add Photo</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="..."></span>
            <br>
            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists btn-simple btn-sm" data-dismiss="fileinput"><i class="tim-icons icon-simple-remove"></i> Remove</a>
            </div>
        </div>
        <h3 class="title mt-4">Charlie Bailey</h3>
        </section> -->
        <!-- User Information -->
        <!-- Profile Sidebar -->
        <section class="section2">
        <ul  class="nav flex-column" role="tablist">
            <li class="nav-item" >
            <nuxt-link to="/dashboard" class="nav-link ">
               <i class="fa fa-home"></i> ড্যাশবোর্ড
            </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/profile" class="nav-link">
                    <i class="fas fa-user"></i>
                    প্রোফাইল
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/notices" class="nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    বিজ্ঞপ্তি
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/news" class="nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    খবর
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/jobposts" class="nav-link">
                    <i class="far fa-copy"></i>
                    চাকরির বিজ্ঞপ্তি
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/success-stories" class="nav-link">
                    <i class="far fa-comment"></i>
                    সফলতার গল্প
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/others" class="nav-link">
                    <i class="far fa-compass"></i>
                    অন্যান্য
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/blogs" class="nav-link">
                    <i class="far fa-comment-dots"></i>
                    সচরাচর জিজ্ঞাসা
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/slider" class="nav-link">
                    <i class="far fa-file-image"></i>
                    স্লাইডার
                </nuxt-link>
            </li>
            <!-- <li class="nav-item">
                <nuxt-link to="/dashboard/slider" class="nav-link">
                    <i class="fas fa-images"></i>
                    Gallery
                </nuxt-link>
            </li> -->
            <li class="nav-item">
                <nuxt-link to="/dashboard/downloads" class="nav-link">
                    <i class="fas fa-download"></i>
                    ডাউনলোড 
                </nuxt-link>
            </li>
            <!-- <li class="nav-item">
                <nuxt-link to="/dashboard/user" class="nav-link">
                    <i class="fas fa-users"></i>
                    Users
                </nuxt-link>
            </li> -->
            <li class="nav-item">
                <nuxt-link to="/dashboard/applicant" class="nav-link">
                    <i class="fas fa-users"></i>
                    প্রার্থী
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/agency" class="nav-link">
                    <i class="fas fa-users"></i>
                    এজেন্সি
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/financial-organization" class="nav-link">
                    <i class="fas fa-users"></i>
                    আর্থিক সংস্থা
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/training-center" class="nav-link">
                    <i class="fas fa-users"></i>
                    প্রশিক্ষণ কেন্দ্র
                </nuxt-link>
            </li>
            <!-- <li class="nav-item">
                <nuxt-link to="/dashboard/user/role" class="nav-link">
                    <i class="fas fa-user-cog"></i>
                    Roles
                </nuxt-link>
            </li> -->
            <li class="nav-item">
                <nuxt-link to="/dashboard/complain" class="nav-link">
                    <i class="fas fa-star"></i>
                    অভিযোগ
                </nuxt-link>
            </li>
            <li class="nav-item">
                <nuxt-link to="/dashboard/opinion" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    মতামত
                </nuxt-link>
            </li>
            
        </ul>
        </section>
        <!-- End Profile Sidebar -->
        <!-- Profile Completion -->
        <!-- <br><br><br> -->
        <div>
        <!-- <div class="progress-container progress-primary">
            <span class="progress-badge">Profile Completion</span>
            <div class="progress-wrapper">
            <div class="progress-info">
                <div class="progress-percentage">
                <span class="text-primary">80%</span>
                </div>
            </div>
            <div class="progress">
                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
            </div>
            </div>
        </div> -->
        </div>
        <!-- End Profile Completion -->
    </div>
</template>
<style >
.section2{
    box-shadow: 3px 5px 3px  #d6d6c2;
    height:650px;
    padding-top:7px; 
}
.nav-link{
    color:#003300;
}
</style>