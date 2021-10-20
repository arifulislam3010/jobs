<template>
     <div style="padding-top:0px;"  class="section " >
        <!-- User Information -->
        <!-- <section class="text-center">
            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                <div class="fileinput-new thumbnail img-circle img-raised">
                <img src="~/assets/icon/logo_custom.png" class="logoImage"/>
                </div>
            </div>
        </section>  -->
        <!-- User Information -->
        
        <section v-if="$auth.user.type == 6 && isMobile" class="section3" >
            <img src="~/assets/icon/logo_custom.png" class="logoImage" style="" />
            <ul  class="nav">
            
                <li class="nav-item " :class="$route.name=='dashboard'?'active2':''" >
                    <nuxt-link to="/dashboard" class="nav-link ">
                    <i class="fa fa-home"></i> Dashboard
                    </nuxt-link>
                </li>
                <li  class="nav-item" :class="$route.name=='dashboard-profile'?'active2':''">
                    <nuxt-link to="/dashboard/profile" class="nav-link">
                        <i class="fas fa-user"></i>
                        Profile
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1 || $auth.user.role_id==6" class="nav-item" :class="$route.name=='dashboard-success-stories'?'active2':''">
                    <nuxt-link to="/dashboard/success-stories" class="nav-link">
                        <i class="far fa-comment"></i>
                        Success Stories
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==6" class="nav-item" :class="$route.name=='dashboard-subcription'?'active2':''">
                    <nuxt-link to="/dashboard/subcription" class="nav-link">
                        <i class="far fa-star"></i>
                        My Subcription 
                    </nuxt-link>
                </li>
                <li class="nav-item" :class="$route.name=='dashboard-setting'?'active2':''">
                    <nuxt-link to="/dashboard/setting" class="nav-link" >
                        <i class="fas fa-cog"></i>
                        Setting 
                    </nuxt-link>
                </li>
                <li class="nav-item" :class="$route.name=='mycv'?'active2':''">
                    <nuxt-link to="/dashboard/mycv" class="nav-link" >
                        <i class="fas fa-file-alt"></i>
                        Mycv
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.type == 6" class="nav-item" >
                    <a class="nav-link" @click="openModal" href="#"><i class="fas fa-file-alt"></i>CV</a>
                </li> -->
            </ul>
        </section>
        <section  v-if="$auth.user.type != 6 || !isMobile" class="section3" >
            <img src="~/assets/icon/logo_custom.png" class="logoImage"/>
            <ul  class="nav flex-column" role="tablist">
                <li class="nav-item " :class="$route.name=='dashboard'?'active2':''" >
                    <nuxt-link to="/dashboard" class="nav-link ">
                    <i class="fa fa-home"></i> Dashboard
                    </nuxt-link>
                </li>
                <li  class="nav-item" :class="$route.name=='dashboard-profile'?'active2':''">
                    <nuxt-link to="/dashboard/profile" class="nav-link">
                        <i class="fas fa-user"></i>
                        Profile
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1" class="nav-item" :class="$route.name=='dashboard-notices'?'active2':''">
                    <nuxt-link to="/dashboard/notices" class="nav-link">
                        <i class="fas fa-clipboard-list"></i>
                        Notice
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1" class="nav-item" :class="$route.name=='dashboard-news'?'active2':''">
                    <nuxt-link to="/dashboard/news" class="nav-link">
                        <i class="fas fa-clipboard-list"></i>
                        News
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1 || $auth.user.role_id == 3" class="nav-item" :class="$route.name=='dashboard-jobposts'?'active2':''">
                    <nuxt-link to="/dashboard/jobposts" class="nav-link">
                        <i class="far fa-copy"></i>
                     Job Posts
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1 || $auth.user.role_id == 3 || $auth.user.role_id == 9" class="nav-item"  :class="[$route.name=='dashboard-job-applicant-id'?'active2':'',$route.name=='dashboard-job-applicant'?'active2':'']">
                    <nuxt-link to="/dashboard/job-applicant" class="nav-link">
                        <i class="far fa-copy"></i>
                        Job applicant
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1 || $auth.user.role_id==6" class="nav-item" :class="$route.name=='dashboard-success-stories'?'active2':''">
                    <nuxt-link to="/dashboard/success-stories" class="nav-link">
                        <i class="far fa-comment"></i>
                        Success Stories
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==6" class="nav-item" :class="$route.name=='dashboard-subcription'?'active2':''">
                    <nuxt-link to="/dashboard/subcription" class="nav-link">
                        <i class="far fa-star"></i>
                         Subcription
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1" class="nav-item" :class="$route.name=='dashboard-others'?'active2':''">
                    <nuxt-link to="/dashboard/others" class="nav-link">
                        <i class="far fa-compass"></i>
                        Others
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1" class="nav-item" :class="$route.name=='dashboard-blogs'?'active2':''">
                    <nuxt-link to="/dashboard/blogs" class="nav-link">
                        <i class="far fa-comment-dots"></i>
                        Blogs
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-slider'?'active2':''">
                    <nuxt-link to="/dashboard/slider" class="nav-link">
                        <i class="far fa-file-image"></i>
                        slider
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.role_id==1" class="nav-item">
                    <nuxt-link to="/dashboard/slider" class="nav-link">
                        <i class="fas fa-images"></i>
                        Gallery
                    </nuxt-link>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-downloads'?'active2':''">
                    <nuxt-link to="/dashboard/downloads" class="nav-link">
                        <i class="fas fa-download"></i>
                        Downloads 
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.role_id==1" class="nav-item">
                    <nuxt-link to="/dashboard/user" class="nav-link">
                        <i class="fas fa-users"></i>
                        Users
                    </nuxt-link>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-admin'?'active2':''">
                    <nuxt-link to="/dashboard/admin" class="nav-link">
                        <i class="fas fa-user"></i>
                        Admin
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1 || $auth.user.role_id==9" class="nav-item" :class="$route.name=='dashboard-applicant'?'active2':''">
                    <nuxt-link to="/dashboard/applicant" class="nav-link">
                        <i class="fas fa-users"></i>
                        Applicants
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1 || $auth.user.role_id == 9" class="nav-item" :class="$route.name=='dashboard-agency'?'active2':''">
                    <nuxt-link to="/dashboard/agency" class="nav-link">
                        <i class="fas fa-users"></i>
                        Agencies
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-financial-organization'?'active2':''">
                    <nuxt-link to="/dashboard/financial-organization" class="nav-link" >
                        <i class="fas fa-money-bill"></i>
                        আ
                    </nuxt-link>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-training-center'?'active2':''">
                    <nuxt-link to="/dashboard/training-center" class="nav-link" >
                        <i class="fas fa-users"></i>
                        Training center
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-important-embassy'?'active2':''">
                    <nuxt-link to="/dashboard/important-embassy" class="nav-link" >
                        <i class="fas fa-users"></i>
                        গুরুত্বপূর্ণ এম্বাসি
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-preparation'?'active2':''">
                    <nuxt-link to="/dashboard/preparation" class="nav-link" >
                        <i class="fas fa-book"></i>
                        বিদেশ যাত্রার প্রস্তুতি
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-to-do'?'active2':''">
                    <nuxt-link to="/dashboard/to-do" class="nav-link" >
                        <i class="fas fa-book"></i>
                        প্রবাসে করণীয়
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-send-money'?'active2':''">
                    <nuxt-link to="/dashboard/send-money" class="nav-link" >
                        <i class="fas fa-book"></i>
                        বৈধ ভাবে টাকা পাঠানো
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-procedure'?'active2':''">
                    <nuxt-link to="/dashboard/procedure" class="nav-link" >
                        <i class="fas fa-book"></i>
                        অভিবাসন প্রক্রিয়া
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.user.role_id==1" class="nav-item">
                    <nuxt-link to="/dashboard/user/role" class="nav-link">
                        <i class="fas fa-user-cog"></i>
                        Roles
                    </nuxt-link>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-complain'?'active2':''">
                    <nuxt-link to="/dashboard/complain" class="nav-link" >
                        <i class="fas fa-star"></i>
                        Complain
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id==1" class="nav-item" :class="$route.name=='dashboard-opinion'?'active2':''">
                    <nuxt-link to="/dashboard/opinion" class="nav-link" >
                        <i class="fas fa-envelope"></i>
                        Opinion
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-guide'?'active2':''">
                    <nuxt-link to="/dashboard/guide" class="nav-link">
                        <i class="fas fa-book"></i>
                        গাইড বুক
                    </nuxt-link>
                </li> -->
                <!-- <li v-if="$auth.user.role_id==3" class="nav-item">
                    <nuxt-link to="/dashboard/admin" class="nav-link">
                        <i class="fas fa-user"></i>
                        অ্যাডমিন
                    </nuxt-link>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-social'?'active2':''">
                    <nuxt-link to="/dashboard/social" class="nav-link" >
                        <i class="fas fa-cog"></i>
                        Social
                    </nuxt-link>
                </li>
                <li class="nav-item" :class="$route.name=='dashboard-setting'?'active2':''">
                    <nuxt-link to="/dashboard/setting" class="nav-link" >
                        <i class="fas fa-cog"></i>
                        Setting
                    </nuxt-link>
                </li>
                <li class="nav-item" :class="$route.name=='mycv'?'active2':''">
                    <nuxt-link to="/dashboard/mycv" class="nav-link" >
                        <i class="fas fa-file-alt"></i>
                        Mycv
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.type == 6" class="nav-item" >
                    <a class="nav-link" @click="openModal" href="#"><i class="fas fa-file-alt"></i> সিভি</a>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-division'?'active2':''">
                    <nuxt-link to="/dashboard/division" class="nav-link">
                        <i class="fas fa-star"></i>
                        Division
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-district'?'active2':''">
                    <nuxt-link to="/dashboard/district" class="nav-link">
                        <i class="fas fa-star"></i>
                        District
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-subdistrict'?'active2':''">
                    <nuxt-link to="/dashboard/subdistrict" class="nav-link">
                        <i class="fas fa-star"></i>
                        Sub District
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-union'?'active2':''">
                    <nuxt-link to="/dashboard/union" class="nav-link">
                        <i class="fas fa-star"></i>
                        Union
                    </nuxt-link>
                </li>
                <!-- <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-country'?'active2':''">
                    <nuxt-link to="/dashboard/country" class="nav-link">
                        <i class="fas fa-star"></i>
                        Country
                    </nuxt-link>
                </li> -->
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-language'?'active2':''">
                    <nuxt-link to="/dashboard/language" class="nav-link">
                        <i class="fas fa-star"></i>
                        Language
                    </nuxt-link>
                </li>
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-degree'?'active2':''">
                    <nuxt-link to="/dashboard/degree" class="nav-link">
                        <i class="fas fa-star"></i>
                        Degree
                    </nuxt-link>
                </li>
                
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-board'?'active2':''">
                    <nuxt-link to="/dashboard/board" class="nav-link">
                        <i class="fas fa-star"></i>
                        Board
                    </nuxt-link>
                </li>
            
                <li v-if="$auth.user.role_id == 1" class="nav-item" :class="$route.name=='dashboard-job'?'active2':''">
                    <nuxt-link to="/dashboard/job" class="nav-link">
                        <i class="fas fa-star"></i>
                        Jobs
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
        <div>
             <CvView ref="cv_view"></CvView>
        </div>
       
    </div>
</template>
<script>
import CvView from "~/components/dashboard/cv";
import { isMobile } from 'mobile-device-detect';
export default {
    data(){
        return{
            isMobile:isMobile
        }
    },
    components:{
        CvView
    },
    methods:{
        async openModal() {
           await this.$axios.get('api/cv').then(response => {
                this.$refs.cv_view.openModal(response.data);
            })
        }
    }
}
</script>

<style  scoped>

.section3{
    /* padding-top:7px;  */
    background: #0ba88c;
    height: 100%;
}

.section3>img{
    left: 3em;
    padding: 10px;
    position: relative;
    display: block;
}
.section3 > .nav-link{
    color:#fff;
    /* padding: 1rem .75rem; */
}
.section3 ul li{
    padding: 2px;
}
.section3 ul li  i{
 color: #fff;
}
.section3 ul li a {
 color: #fff;
 padding: 10px;
}
.section3 > .nav-link.active, .nav-link:hover {
    color: #0ba88c;
    background: #fff;
    border-radius: 25px 0px 0px 25px;
}
.section3 > .nav-link.active, .nav-link:hover i {
    color: #0ba88c;
    background: #fff;
    border-radius: 25px 0px 0px 25px;
}
.section3> .active2{
    /* background-color: greenyellow; */
    background-color:#fff;
    color: #0ba88c;
    border-radius: 25px 0px 0px 25px;
}
.section3 > .active2 a{
    color:#0ba88c;
}
.section3 >.active2 a > i{
    color:#0ba88c;
}
</style>