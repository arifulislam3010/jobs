<template>
    <div style="">
        <div class="container">
        <!-- {{list}} -->
        <div class="row" style="position:relative;">
            <div class="overlay"></div>
            <b-carousel class="col-md-12"
                id="carousel-1"
                v-model="slide"
                :interval="4000"
                controls
                indicators
                style="text-shadow: 1px 1px 2px #333;padding:0"
                @sliding-start="onSlideStart"
                @sliding-end="onSlideEnd"
            >
            <!-- Text slides with image -->
            <b-carousel-slide v-for="(item,key) in list.slider" :key="key"
                    :text="item.name"
                    :img-src="item.image"
                ></b-carousel-slide>
            </b-carousel>
        </div>
        <div class="row">
            <div class="card_top col-md-12 row">
                <div class="col-md-4 ">
                    <div class="profile_picture">
                     <img v-if="list.contact.image!=''" :src="list.contact.image" />
                     <img v-else src="~/assets/image/i.png" />
                    </div>
                </div>
                <div class="col-md-8">
                     <span style="font-weight:700px;font-size:24px;color:#fff;">{{list.user.name}}</span><br>
                     <span style="color:#fff;" v-if="list.contact.registration_number">রেজিস্ট্রেশন নম্বর: {{list.contact.registration_number}}</span>
                     
                      <p style="margin: 0px; color:#fff;" >
                          <i class="fas fa-phone-alt"></i> {{list.contact.contact_number}}
                     <i class="fas fa-map-marker-alt"></i> <span v-if="list.address">{{list.address[0].name}}</span>
                      </p>
                     <p style="color:#fff;">
                     <i class="fas fa-globe"></i> <a v-if="list.contact.website" target="_blank" :href="list.contact.website">{{list.contact.website}}</a>
                     <i class="far fa-envelope"></i>{{list.user.email}}</p>
                     <p style="color:#fff;">
                         <span >&nbsp;&nbsp;পরবর্তীতে এই এজেন্সির নিউজলেটার পেতে সাবস্ক্রাইব করুন &nbsp;&nbsp;</span>
                        <div class="mt-2" style="margin:20px auto" v-if="subscribe">
                            <button @click="subscribeAgency" class="btn btn-sm btn-success" >আনসাবস্ক্রাইব</button>
                        </div>
                        <div class="mt-2" style="margin:20px auto;" v-else>
                            <button @click="subscribeAgency" class="btn btn-sm btn-success" >সাবস্ক্রাইব</button>
                        </div>
                     </p>
                </div>
               
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 card" style="width:100%;">
                <div style="width:100%;text-align:left; padding:10px;">
                    <!-- <h5 style="padding-bottom:1px;padding-top:10px"></h5> -->
                    <p style="font-size:16px;font-weight:bold; margin: 0px;border-bottom: 1px solid #ccc;
    padding-bottom: 5px;">About Company</p>
                </div>
                <div style="width:100%;text-align:justify; padding:10px;">
                 <p  v-html="list.contact.about">
                 </p>
                </div>
            </div>
            <div v-if="imgs.length>0" style="padding: 0px;">
                <div class="col-md-12 card"  style="width:100%;background:#fff;margin-bottom:0px;border-radius:4px 4px 0 0">
                    <div style="width:100%;text-align:left;">
                         <p style="font-size:16px;font-weight:bold; margin: 0px;border-bottom: 1px solid #ccc;
    padding-bottom: 5px;">Gallery</p>
                    </div>
                    <div class="row mt-3">
                        <div>
                            <vue-easy-lightbox
                                escDisabled
                                moveDisabled
                                :visible="visible"
                                :imgs="imgs"
                                :index="index"
                                @hide="handleHide"
                            ></vue-easy-lightbox>
                        </div>
                        <div class="col-md-2 mt-1" v-for="(list,key) in imgs" :key="key">
                            <div @click="showMultiple(key)">
                                <img :src="list.src" alt="Norway" style="width:100%;height:170px;">
                                <p>{{list.title}}</p>
                            </div>
                        </div>
                        <div v-if="gallery.meta" class="col-md-12 text-center mb-4">
                            <div  v-if="gallery.meta.current_page != gallery.meta.last_page"><button @click="getGallery(gallery.meta.current_page+1)" class="btn btn-sm btn-info">আরো দেখুন</button></div>
                            <!-- <pagination :data="Object.assign({},gallery)" @pagination-change-page="getGallery"></pagination> -->
                        </div>
                    </div>
                </div>
                
            </div>
            <div v-if="list.contact.map_link" class="col-md-12  mb-4 card">
                <div id="test" style="width:100%;height:300px" v-html="list.contact.map_link" >
                    <!-- <iframe :src="list.contact.map_link" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                </div>
            </div>
            
            <div>
                <div class="row mt-2 mobile-padding">
                    <div class="col-sm-3">
                        <div class="rating-block">
                            <h4>এভারেজ রেটিং</h4>
                            <h2 class="bold padding-bottom-7">{{list.avg_rating}} <small>/ 5</small></h2>
                            <star-rating :star-size="medium_size" :increment="increment" :show-rating="false" :read-only="true" :rating="list.avg_rating"></star-rating>
                        </div>
                    </div>
                    <div class="col-sm-3 mobile-margin">
                        <h4>রেটিং ব্রেকডাউন</h4>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:0;">
                                <div style="height:9px; margin:5px 0;">5 <span class="glyphicon glyphicon-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <b-progress variant="success" :value="list.five" :max="list.total" class="mb-3"></b-progress>
                            </div>
                            <div class="pull-right" style="margin-left:10px;line-height:0">{{list.five}}</div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:0;">
                                <div style="height:9px; margin:5px 0;">4 <span class="glyphicon glyphicon-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <b-progress variant="info" :value="list.four" :max="list.total" class="mb-3"></b-progress>
                            </div>
                            <div class="pull-right" style="margin-left:10px;line-height:0">{{list.four}}</div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:0;">
                                <div style="height:9px; margin:5px 0;">3 <span class="glyphicon glyphicon-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <b-progress variant="primary" :value="list.three" :max="list.total" class="mb-3"></b-progress>
                            </div>
                            <div class="pull-right" style="margin-left:10px;line-height:0">{{list.three}}</div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:0;">
                                <div style="height:9px; margin:5px 0;">2 <span class="glyphicon glyphicon-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <b-progress variant="warning" :value="list.two" :max="list.total" class="mb-3"></b-progress>
                            </div>
                            <div class="pull-right" style="margin-left:10px;line-height:0">{{list.two}}</div>
                        </div>
                        <div class="pull-left">
                            <div class="pull-left" style="width:35px; line-height:0;">
                                <div style="height:9px; margin:5px 0;">1 <span class="glyphicon glyphicon-star"></span></div>
                            </div>
                            <div class="pull-left" style="width:180px;">
                                <b-progress variant="danger" :value="list.one" :max="list.total" class="mb-3"></b-progress>
                            </div>
                            <div class="pull-right" style="margin-left:10px;line-height:0">{{list.one}}</div>
                        </div>
                    </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2" >
                        
                    </div>
                    <div v-if="$auth.loggedIn" class="col-sm-3 mobile-margin">
                        <div v-if="$auth.user.type !=3">
                            <h4 v-if="check"><a  @click="openModal()" href="#">রেটিং এবং রিভিউ আপডেট করুন</a></h4>
                            <h4 v-else><a @click="openModal()" href="#">রেটিং এবং রিভিউ দিন</a></h4>
                            <div>
                                <star-rating :star-size="size" :increment="increment" :show-rating="false" @rating-selected ="setRating" :rating="rating"></star-rating>
                            </div>
                        </div>
                    </div>			
		        </div>
                <div v-if="reviews" class="row mobile-margin">
                    <div v-if="reviews.length>0" class="col-sm-7">
                        <div class="review-block">
                            <div class="row"  v-for="(review,key) in reviews" :key="key">
                                <div class="col-sm-3">
                                    <img height="80px" width="80px" v-if="review.reviewer_image.image" :src="review.reviewer_image.image" alt="" class="img-rounded">
                                    <img height="80px" width="80px" v-else src="https://www.w3schools.com/howto/img_avatar.png" class="img-rounded">
                                    <div class="review-block-name"><b>{{review.reviewer_name.name}}</b></div>
                                    <div class="review-block-date">{{review.published_at}}</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="review-block-rate">
                                        <star-rating :star-size="small_size" :increment="increment" :show-rating="false" :read-only="true" :rating="review.rating"></star-rating>
                                    </div>
                                    <div class="review-block-description">{{review.comment}}</div>
                                    <!-- <div class="col-sm-12 mt-4">
                                        <div v-for="(rep,key2) in review.replies" :key="key2" class="row">
                                            <div class="col-md-2">
                                                <b>{{review.agency_name.name}}</b>
                                            </div>
                                            <div class="col-md-10">
                                                <span>{{rep.comment}}</span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <button @click="openReplyModal(review.id)" class="btn btn-sm pull-right">Reply</button> -->
                                </div>
                                <div class="col-sm-3">
                                    
                                </div>
                                <div style="height:20px"></div>
                            </div>
                        </div>
                    </div>
                    <div v-else style="width:100%;height:50px;">

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="mb-4 card agency-box1">
                <div style="width:100%;text-align:center;background:#488354;border-radius:4px 4px 0 0">
                    <p style="font-size:20px;font-weight:bold;margin-bottom:4px;margin-top:5px;color:#fff">যেসব দেশে জনবল পাঠানো হয়</p>
                </div>
                <div class="mt-2" style="width:100%">
                    <div style="width:50%;float:left;">
                        <span v-for="(item,key) in list.country" :key="key"><span v-if="key%2 == 1" >&nbsp;&nbsp; <i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{item.country_name}} <br></span></span>
                    </div>
                    <div style="width:50%;float:left;">
                        <span v-for="(item,key) in list.country" :key="key"><span v-if="key%2 == 0" >&nbsp;&nbsp; <i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{item.country_name}} <br></span></span>
                    </div>
                </div>
            </div> -->
            <!-- <div class="mb-4 card agency-box2">
                <div style="width:100%;text-align:center;background:#488354;border-radius:4px 4px 0 0">
                    <p style="font-size:20px;font-weight:bold;margin-bottom:4px;margin-top:5px;color:#fff">যেসব সেক্টরে জনবল পাঠানো হয় </p>
                </div>
                <div class="mt-2" style="width:100%">
                    <div style="width:100%;">
                        <span v-for="(item,key) in list.job" :key="key"><span>&nbsp;&nbsp; <i class="fa fa-dot-circle-o" aria-hidden="true"></i> {{item.name}} <br></span></span>
                    </div>
                </div>
            </div> -->
            <!-- <div  class="col-md-12 card">
                <div style="width:100%;text-align:left;background:#fff;border-radius:4px 4px 0 0">
                    <p style="font-size:20px;font-weight:bold;margin-bottom:4px;margin-top:5px;">যোগাযোগ</p>
                </div>
                <table class="table ">
                <thead>
                    <tr>
                        <td><b>ফোন</b></td>
                        <td>{{list.contact.contact_number}}</td>
                    </tr>
                </thead>
                <tbody >
                    <tr>
                        <td><b>ইমেইল/ মোবাইল নম্বর</b></td>
                        <td>{{list.user.email}}{{list.user.phone}}</td>
                    </tr>
                    <tr>
                        <td><b>ঠিকানা</b></td>
                        <td><span v-if="list.address">{{list.address[0].name}}</span></td>
                    </tr>
                    <tr v-if="list.contact.website">
                        <td><b>ওয়েবসাইট</b></td>
                        <td ><a target="_blank" :href="list.contact.website">{{list.contact.website}}</a></td>
                    </tr>
                </tbody>
                </table>
                
            </div> -->
            
        </div>
        <!-- <button @click="getUserRating()">Test</button> -->
        <div>
            <div class="modal fade"  :class="modalOpen?'show':''" id="exampleModal"  :style="modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5  class="modal-title" id="exampleModalLabel">রেটিং এবং রিভিউ</h5>
                    <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div v-if="reply" class="col-md-12">
                            <div class="mt-3" style="width:100%" > 
                                <textarea v-model="reply_comment" class="form-control" name="" id="" cols="10" rows="2"></textarea>
                            </div>
                        </div>
                        <div v-else class="col-md-12">
                            <div style="width:100%" > 
                                <star-rating style="margin-left:25%" :star-size="size" :increment="increment" :show-rating="false" @rating-selected ="setRating" :rating="rating"></star-rating>
                            </div>
                            <div class="mt-3" style="width:100%" > 
                                <textarea v-model="comment" class="form-control" name="" id="" cols="10" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-success" @click="replyCommnet()" data-dismiss="modal">reply Submit</button> -->
                    <button type="button" class="btn btn-success" v-if="loader" data-dismiss="modal"><i class="fa fa-cog fa-spin"></i> সাবমিট</button>
                    <button type="button" class="btn btn-success" v-else @click="rate()" data-dismiss="modal"> সাবমিট</button>
                    <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">বাদ দিন</button>
                </div>
            </div>
         </div>
        </div>
        </div>
        </div>
    </div> 
</template>
<script>
import pagination from 'laravel-vue-pagination';

export default {
    components:{
        pagination
    },
    data(){
        return{
            subscribe:0,
            avg_rating:0,
            one:0,
            two:0,
            three:0,
            four:0,
            five:0,
            loader:false,
            reply_comment:'',
            parent_comment_id:'',
            reply:false,
            check:0,
            reviews:'',
            comment:'',
            size:35,
            small_size:20,
            medium_size:25,
            modalOpen:false,
            max:100,
            value:10,
            increment:0.5,
            rating:0,
            imgs: [], 
            visible: false,
            index: 0 ,
            slide: 0,
            sliding: null,
            gallery:[],
            list:{
                user:'',  
                contact:'',
                address:'', 
                job:'',    
                country:'',
                slider:'',
                one:0,
                two:0,
                three:0,
                four:0,
                five:0,
            }
        }
    },
    methods:{
        setWidth(){
            var a = document.getElementById("test");
            if(a.children.length>0){
                a.children[0].width = '100%'
                a.children[0].height = '300'
            }
        },
        openModal(){
            this.modalOpen = true
        },
        CloseModal(){
            this.modalOpen = false
        },
        openReplyModal(comment_id,reply=""){
            this.modalOpen = true
            this.reply = true
            this.parent_comment_id = comment_id,
            this.reply_comment = reply
        },
        setRating: function(rating){
            this.rating= rating;
            this.modalOpen = true;
            this.reply = false
        },
        showMultiple(index) {
            this.index = index 
            this.show()
        },
        show() {
            this.visible = true
        },
        handleHide() {
            this.visible = false
        },
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        },
        async getGallery(page=1){
            var data = {
                slug:this.$route.params.slug,
                limit:6,
                type:'gallery'
            }
            await this.$axios.post('api/get-gallery2?page='+page,data).then(response=>{
                this.gallery = response.data
                this.imgs = this.imgs.concat(response.data.data)
            })
        },
        async getInfo(){
            var data = {
                slug:this.$route.params.slug
            }
            await this.$axios.post('api/get-agency-info',data).then(response=>{
                this.list = response.data
                this.getReview(1);
            })
        },
        async rate(){
            this.loader = true
            var data = {
                agency_id:this.list.user.id,
                reviewer_id:this.$auth.user.id,
                rating:this.rating,
                comment:this.comment
            }
            await this.$axios.post('api/rate',data).then(response=>{
                this.getReview(1);
                this.loader = false
                this.modalOpen = false
                this.$swal({
                    icon: 'success',
                    title: 'অভিনন্দন',
                    text:'আপনার রিভিউ এবং রেটিং সংরক্ষিত হয়েছে',
                    confirmButtonText:'ওকে'
                })
            }).catch(error=>{
                this.loader = false
                this.modalOpen = false
            })
        },
        async replyCommnet(){
            var data = {
                agency_id:this.$auth.user.id,
                reviewer_id:this.$auth.user.id,
                comment:this.reply_comment,
                parent_comment_id:this.parent_comment_id
            }
            await this.$axios.post('api/review-reply',data).then(response=>{
                this.getReview(1);
            })
        },
        async subscribeAgency(){
            if(this.$auth.loggedIn){
                if(this.subscribe){
                    this.$swal({
                        title: 'আপনি কি এই এজেন্সির নিউজলেটার বাদ দিতে চান ?',
                        icon: 'info',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'হ্যাঁ',
                        cancelButtonText: 'না'
                    }).then((result) => {
                        if (result.value) {
                            this.subscribeAgency2();
                        }
                    })
                }
                else{
                    this.$swal({
                        title: 'আপনি কি এই এজেন্সির নিউজলেটার পেতে চান?',
                        icon: 'info',
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'হ্যাঁ',
                        cancelButtonText: 'না'
                    }).then((result) => {
                        if (result.value) {
                            this.subscribeAgency2();
                        }
                    })
                }
                
            }
            else{
                this.$router.push('/login');
            }
        },
        async subscribeAgency2(){
            var data = {
                agency_id:this.list.user.id
            }
            await this.$axios.post('api/subscribe',data).then(response=>{
                this.subscribe = response.data.subscribe
                if (this.subscribe){
                    this.$swal({
                        icon: 'success',
                        title: 'অভিনন্দন',
                        text:'আপনি সাবস্ক্রাইব করতে সক্ষম হয়েছেন',
                        confirmButtonText:'ওকে'
                    })
                }else{
                    this.$swal({
                        icon: 'success',
                        title: 'অভিনন্দন',
                        text:'আপনি আনসাবস্ক্রাইব করতে সক্ষম হয়েছেন',
                        confirmButtonText:'ওকে'
                    })
                }
            })
        },
        async getReview(page=1){
            var data = {
                agency_id:this.list.user.id
            }
            await this.$axios.post('api/get/review?page='+page,data).then(response=>{
                this.reviews = response.data.data
                if(this.$auth.loggedIn){
                    this.getUserRating();
                }
                else{
                    this.setWidth();
                }
            })
        },
        async getUserRating(){
            var self = this
            await this.$axios.get('api/get/user-rating?agency_id='+this.list.user.id).then(response=>{
                if(response.data){
                    if(response.data.data){
                        this.rating  = response.data.data.rating
                        this.comment = response.data.data.comment
                    }
                    this.list.one   = response.data.one
                    this.list.two   = response.data.two
                    this.list.three = response.data.three
                    this.list.four  = response.data.four
                    this.list.five  = response.data.five
                    this.list.total = response.data.total
                    this.subscribe  = response.data.subscribe
                    this.check      = response.data.check
                    setTimeout(()=>{
                        self.setWidth();
                    },1000)
                }
            })
        }
    },
    mounted(){
        this.getInfo();
        this.getGallery();
        this.getReview();
        if(this.$auth.loggedIn){
            this.getUserRating();
        }
    }
}
</script>
<style >
    .carousel-item img{
        height: 300px !important;
        width: 100% !important;
    }
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #75ab28;
        border-color: #75ab28;
    }
</style>
<style scoped>
    .overlay{
        height: 100%;
        position: absolute;
        background: #0000007a;
        z-index: 1;
    }
    .card_top{
        padding: 2px;
        position: absolute;
        top: 111px;
        left: 0px;
        z-index: 2;
    }
    .card_top i{
        color:#fff !important;
    }
    .card_top  p{
        color:#fff !important;
    }
     .card_top  span{
        color:#fff !important;
    }
    .card_top  a{
        color:#fff !important;
    }
    .profile_picture{
        border-radius: 50%;
        width: 100px;
        height: 100px;
        border: 1px solid #ccc;
        float: right;
        position: relative;
    }
    .profile_picture img{
        object-fit: contain;
        width: 100%;
        position: relative;
        height: 100%;
    }
    .btn-grey{
        background-color:#D8D8D8;
        color:#FFF;
    }
    .rating-block{
        background-color:#FAFAFA;
        border:1px solid #EFEFEF;
        padding:15px 15px 20px 15px;
        border-radius:3px;
    }
    .bold{
        font-weight:700;
    }
    .padding-bottom-7{
        padding-bottom:7px;
    }

    .review-block{
        background-color:#FAFAFA;
        border:1px solid #EFEFEF;
        padding:15px;
        border-radius:3px;
        margin-bottom:15px;
    }
    .review-block-name{
        font-size:12px;
        margin:10px 0;
    }
    .review-block-date{
        font-size:12px;
    }
    .review-block-rate{
        font-size:13px;
        margin-bottom:15px;
    }
    .review-block-title{
        font-size:15px;
        font-weight:700;
        margin-bottom:10px;
    }
    .review-block-description{
        font-size:13px;
    }
    .modal {
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }
    .agency-box1{
        width:32% !important;
        clear:both
    }
    .agency-box2{
        width:32% !important;
        margin-left:2%
    }
    .agency-box3{
        width:32% !important;
        margin-left:2%
    }
    @media only screen and (max-width: 600px) {
        .agency-box1{
            width:96% !important;
            margin-left:2%
        }
        .agency-box2{
            width:96% !important;
            margin-left:2%
        }
        .agency-box3{
            width:96% !important;
            margin-left:2%
        }
        .mobile-padding{
            padding:0px 10px 5px 10px;
        }
        .mobile-margin{
            margin-top: 20px;
        }
    }
</style>