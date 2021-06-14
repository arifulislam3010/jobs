<template>
    <div>
        <div id="printMe">
          <div  class="container">
              <div class="text-center mb-2" v-if="checkPrint">
                <img style="height:100px;width:100px;" src="/argon/img/logo.png">
              </div>
              <div class="row" v-if="post.image">
                  <iframe  style="width:100%;height:500px" v-if="post.image.match(/.pdf/g) == '.pdf'" :src="post.image" ></iframe>
                  <img style="width:100%;height:400px" v-else :src="post.image" alt="">
              </div>
              <div class="row mt-4">
                  <span style="color:#000;font-size:24px;font-weight:bold;">{{post.headline}}</span>
              </div>
              <div class="row mt-1">
                <div style="display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;">
                  <div class="details"  v-html="post.content"></div>
                </div>
              </div>
              
              <div class="row mt-3">
                  <span style="color:#000;font-size:16px;font-weight:bold;">শর্ত সমূহ:</span>
              </div>
              <div class="col-md-12 condition">
                  <p v-if="post.experience"><span style="font-weight:bold;">কমপক্ষে অভিজ্ঞতা(বৎসর): </span>{{post.experience}}</p>
                  <p v-if="post.country"><span style="font-weight:bold;">প্রযোজ্য দেশ: </span>{{post.country.country_name}}</p>
                  <p v-if="post.job"><span style="font-weight:bold;">প্রযোজ্য চাকরি: </span>{{post.job.name}}</p>
                  <p v-if="post.language"><span style="font-weight:bold;">প্রযোজ্য ভাষা: </span>{{post.language.name}}</p>
              </div>
              <div class="mt-2" v-if="checkPrint">
                <div style="width:100%;text-align:center">
                  অভিবাসী বাতায়ন
                </div>
              </div>
          </div>
        </div>
        <div>
          <div class="container">
              <div class="row mt-3">
                  <span style="color:#000;font-size:16px;font-weight:bold;">এজেন্সি:</span>&nbsp;
                  <span @click="go(post.author_slug)" style="cursor:pointer">{{post.author}}</span>
              </div>
              
              <div class="row mt-4" v-if="$auth.user">
                <div v-if="check.favourite">
                  <button v-if="$auth.user.type!=3" @click="removeTofavourite()" class="btn btn-sm  btn-success">পছন্দের থেকে বাদ দিন</button>
                </div>
                <div v-else>
                  <button v-if="$auth.user.type!=3" @click="addTofavourite()" class="btn btn-sm  btn-success">পছন্দের তালিকায় যোগ করুন</button>
                </div>
                &nbsp;
                <button @click="print()" class="btn btn-sm btn-success"><i class="fas fa-print" aria-hidden="true"></i> প্রিন্ট করুন</button>
              </div>
              <div class="row mt-4" v-else>
                <div v-if="check.favourite">
                  <button @click="removeTofavourite()" class="btn btn-sm  btn-success">পছন্দের থেকে বাদ দিন</button>
                </div>
                <div v-else>
                  <button @click="addTofavourite()" class="btn  btn-sm btn-success">পছন্দের তালিকায় যোগ করুন</button>
                </div>
                &nbsp;
                <button @click="print()" class="btn btn-sm btn-success"><i class="fas fa-print" aria-hidden="true"></i> প্রিন্ট করুন</button>
              </div>
              <div class="mt-2">
                  <div v-if="$auth.user" style="width:100%;text-align:center;padding-bottom:20px">
                    <button v-if="check.applyied>0" class="btn  btn-success">আবেদন করা হয়েছে</button>
                    <button  v-if="check.applyied == 0 && loader == true " class="btn  btn-success"><i class="fa fa-cog fa-spin"></i> আবেদন হচ্ছে</button>
                    <button v-if="check.applyied == 0 && loader==false && $auth.user.type!=3"  @click="apply()" class="btn  btn-success"> আবেদন করুন</button>
                  </div>
                  <div v-else style="width:100%;text-align:center;padding-bottom:20px">
                    <button v-if="check.applyied>0" class="btn  btn-success">আবেদন করা হয়েছে</button>
                    <button  v-if="check.applyied == 0 && loader == true " class="btn  btn-success"><i class="fa fa-cog fa-spin"></i> আবেদন হচ্ছে</button>
                    <button v-if="check.applyied == 0 && loader==false"  @click="apply()" class="btn  btn-success"> আবেদন করুন</button>
                  </div>
              </div>
          </div>
        </div>
        <div
            id="whole_modal"
            class="modal fade"
            :class="modalOpen?'show':''"
            :style="modalOpen?'display: block !important; overflow: scroll !important; padding-right: 17px !important;':''"
          >
            <div class="modal-dialog modal-md" id="modal">
              <div class="modal-content">
                <div class="modal-body">
                  <div style="width:100%;text-align:center">
                      <img src="~/assets/icon/cross.png" height="70px;width:70px;" alt="">
                  </div>
                  <div style="width:100%;height:10px;"></div>
                  <div style="width:100%;text-align:center">
                      <span style="font-size:30px;font-weight:bold">দুঃখিত</span>
                  </div>
                  <div v-if="error_language" style="width:100%;">
                      <div style="width:100%;height:10px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;font-weight:bold"><i class="fa fa-language" aria-hidden="true"></i> ভাষাঃ</span>
                      </div>
                      <div style="width:100%;height:4px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;">আপনি {{error_language}} ভাষায় পারদর্শী নন</span><br>
                          <span style="font-size:16px;">আপনি {{error_language}} ভাষায় পারদর্শী হলে আপনার প্রোফাইল আপডেট করে পুনরায় আবেদন করুন</span>
                      </div>
                      <div style="width:100%;height:10px;"></div>
                  </div>
                  <div v-if="error_country" style="width:100%;">
                      <div style="width:100%;height:10px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;font-weight:bold"><i class="fa fa-map-marker" aria-hidden="true"></i> দেশঃ</span>
                      </div>
                      <div style="width:100%;height:4px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;">আপনি {{error_country}} যেতে আগ্রহী নন</span><br>
                          <span style="font-size:16px;">আপনি {{error_country}} যেতে আগ্রহী হলে আপনার প্রোফাইল আপডেট করে পুনরায় আবেদন করুন</span>
                      </div>
                      <div style="width:100%;height:10px;"></div>
                  </div>
                  <div v-if="error_job" style="width:100%;">
                      <div style="width:100%;height:10px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;font-weight:bold"><i class="fa fa-tasks" aria-hidden="true"></i> চাকুরিঃ</span>
                      </div>
                      <div style="width:100%;height:4px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;">আপনি {{error_job}} পদে  আগ্রহী নন</span><br>
                          <span style="font-size:16px;">আপনি {{error_job}} পদে  আগ্রহী হলে আপনার প্রোফাইল আপডেট করে পুনরায় আবেদন করুন</span>
                      </div>
                      <div style="width:100%;height:10px;"></div>
                  </div>
                  <div v-if="error_experience" style="width:100%;">
                      <div style="width:100%;height:10px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;font-weight:bold"><i class="fa fa-briefcase" aria-hidden="true"></i> অভিজ্ঞতাঃ</span>
                      </div>
                      <div style="width:100%;height:4px;"></div>
                      <div style="width:100%;text-align:center;border:2px solid #2dce89">
                          <span style="font-size:20px;">আপনার {{error_experience}} বছর অভিজ্ঞতা নেই</span><br>
                          <span style="font-size:16px;"> যদি আপনার {{error_experience}} বছর অভিজ্ঞতা থাকে তবে আপনার প্রোফাইল আপডেট করে পুনরায় আবেদন করুন</span>
                      </div>
                      <div style="width:100%;height:10px;"></div>
                  </div>
                  <div  style="width:100%;text-align:center">
                      <div style="width:100%;height:15px;"></div>
                      <button @click="closeModal()" class="btn btn-success">ওকে</button>
                  </div>
                  <div  style="width:100%;">
                      <div style="width:100%;height:25px;"></div>
                      <button class="btn btn-outline-success  btn-block"><a  href="/dashboard/profile">অনুগ্রহপূর্বক আপনার প্রোফাইল আপডেট করুন</a></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex';
  function updateprofile(){
    alert("ok")
  }
  export default {
    data() {
      return {
        modalOpen:false,
        error_language:'',
        error_country:'',
        error_job:'',
        error_experience:'',
        checkPrint:false,
        loader:false,
        applyModalOpen: false,
        check:{
            applyied:0,
            favourite:0
        },
        type: '',
        seria:['১','২','৩','৪','৫','৬','৭','৮','৯','১০','১১','১২','১৩','১৪',' ১৫']
      }
    },
    mounted(){
      this.get();
      if(this.$auth.loggedIn){
        this.checkApply();
      }
      var self = this
      var whole_modal = document.getElementById("whole_modal");
      whole_modal.addEventListener("click", function(e){
        if(e.target.id == 'whole_modal'){
          self.closeModal();
        }
      });
    },
    computed: mapGetters({
      post: 'frontent/post'
    }),
    methods: {
      closeModal(){
        this.modalOpen = false
        this.error_language = ''
        this.error_country = ''
        this.error_job = ''
        this.error_experience = ''
      },
      print () {
         var self = this
        self.checkPrint = true
        setTimeout(()=>{
          self.$htmlToPaper('printMe');
        },1000)
        // this.checkPrint = true
        // Pass the element id here
        // this.$htmlToPaper('printMe');
       
        setTimeout(()=>{
          self.checkPrint = false
        },2000)
      },
      async addTofavourite(){
        if(this.$auth.loggedIn){
          await this.$axios.get('api/add/favourite/'+this.post.id).then(response=>{
            this.check.favourite = 1;
            this.$swal({
              icon: 'success',
              title: 'অভিনন্দন',
              text:'পছন্দের তালিকায় যোগ করতে সক্ষম হয়েছেন',
              confirmButtonText:'ওকে'
            })
          })  
        }
        else{
          this.$router.push('/login');
        }
      },
      async removeTofavourite(){
        if(this.$auth.loggedIn){
          await this.$axios.get('api/remove/favourite/'+this.post.id).then(response=>{
            this.check.favourite = 0;
            this.$swal({
              icon: 'success',
              title: 'অভিনন্দন',
              text:'পছন্দের তালিকা থেকে বাদ দিতে সক্ষম হয়েছেন',
              confirmButtonText:'ওকে'
            })
          })  
        }
        else{
          this.$router.push('/login');
        }
      },
      go(slug){
        this.$router.push('/agency/'+slug)
      },
      async get () {
        await this.$store.dispatch('frontent/get_post',this.$route.params.slug)
      },
      async checkApply(){
        await this.$axios.get('api/check-apply/'+this.$route.params.slug).then(response=>{
          this.check.applyied = response.data.applyed;
          this.check.favourite = response.data.favourite;
        })
      },
      apply(){
        if(this.$auth.loggedIn){
          this.$swal({
            title: 'আপনি কি আবেদনের জন্য নিশ্চিত?',
            icon: 'info',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'হ্যাঁ',
            cancelButtonText: 'না'
          }).then((result) => {
            if (result.value) {
              this.apply2();
            }
          })    
        }
        else{
          this.$router.push('/login');
        }
      },
      
      apply2(){
        this.loader = true;
        this.$axios.get('api/apply/'+this.post.id).then(response=>{
          this.loader = false;
          this.check.applyied = 1;
          this.$swal({
            icon: 'success',
            title: 'অভিনন্দন',
            text:'আপনার আবেদন গৃহীত হয়েছে',
            confirmButtonText:'ওকে'
          })
        })
        .catch(error => {
          this.loader = false;
          this.error_language = error.response.data.language_error
          this.error_country = error.response.data.country_error
          this.error_job = error.response.data.job_error
          this.error_experience = error.response.data.experience_error
          this.modalOpen = true
        })
      }
    }
  }
</script>

<style scoped>
.table-bordered th,td{
  padding:10px;
}
a:hover {
  color: #fff !important;
}
.btn:hover a{
  color: #fff !important;
}
.modal {
  background-color: rgb(0, 0, 0) !important; /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4) !important; /* Black w/ opacity */
}
</style>
<style>
.details p{
  margin-top: 0em;
  margin-bottom: 0em;
  line-height: 1.7em;
}
.details span{
  margin-top: 0em;
  margin-bottom: 0em;
}
.details strong{
  font-weight: bold;
}
.condition p{
  margin-top: 0em;
  margin-bottom: 0em;
  line-height: 1.7em;
}
@media only screen and (max-width: 600px) {
  .container{
    padding-left: 28px;
  }
}
</style>