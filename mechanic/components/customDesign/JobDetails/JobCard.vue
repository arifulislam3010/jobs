<template>
    <div>
       <div class="job-card-content-wrapper p-3 mb-3">
        <div class="job-card-header">
          <div class="job-title">
            <div class="logo-wrapper">
              <img
                :src="post.image"
                alt="job logo"
                class="img-fluid"
              />
            </div>
            <div class="job-subtitle">
              <div class="job-position">
                <h4>{{post.headline}}</h4>
                <p>{{post.author}}</p>
              </div>
            </div>
            <div class="job-card-badge">{{post.job.name}}</div>
          </div>
          <div class="save-badge" v-if="$auth.user && $auth.user.type!=3" >
            <button v-if="check.favourite" @click="removeTofavourite()" style="width:94px"><i class="far fa-bookmark"></i>Remove</button>
            <button v-else @click="addTofavourite()"><i class="far fa-bookmark"></i>Save</button>
          </div>
        </div>
        <div class="job-card-body mt-2 pr-3 pl-5">
          <div class="row">
            <div class="col">
              <div class="job-details-wrapper">
                <div class="job-details-title">
                  <p>কমপক্ষে অভিজ্ঞতা(বৎসর)</p>
                </div>
                <div class="job-details-sub-title">
                  <h5>{{post.experience}}</h5>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="job-details-wrapper">
                <div class="job-details-title">
                  <p>প্রযোজ্য চাকরি</p>
                </div>
                <div class="job-details-sub-title">
                  <h5>{{post.job.name}}</h5>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="job-details-wrapper">
                <div class="job-details-title">
                  <p>প্রযোজ্য ভাষা</p>
                </div>
                <div class="job-details-sub-title">
                  <h5>{{post.language.name}}</h5>
                </div>
              </div>
            </div>
            <!-- <div class="col">
              <div class="job-details-wrapper">
                <div class="job-details-title">
                  <p>Experience</p>
                </div>
                <div class="job-details-sub-title">
                  <h5>3 to 5 Years</h5>
                </div>
              </div>
            </div> -->
          </div>
        </div>
       </div>
       <div class="job-card-footer ">
        <div
          class="job-card-footer-content   pl-5 pr-3 d-flex justify-content-between align-items-center "
        >
          <div class="job-collapse-button">
            <b-button v-b-toggle.collapse-1 variant="link"
              >Job Details <i class="fas fa-angle-down"></i
            ></b-button>
          </div>
          <div class="job-post-status">
            <p>Posted <span> 8hrs ago</span></p>
          </div>
        </div>
       </div>
       <b-collapse id="collapse-1" class="mt-2">
        <div class="job-card-main-content-wrapper" id="collapseExample">
          <div class="job-card-main-content  d-flex justify-content-between">
            <div class="job-card-main-content-heading">
              <div class="job-card-heading">
                <p>We are looking for...</p>
                <h4>{{post.headline}}</h4>
              </div>
            </div>
            <div class="card-expand-close-button-wrapper">
              <b-button class="active" v-b-toggle.collapse-1 variant="button"
                ><i class="fas fa-times"></i> close</b-button
              >
                    <button v-if="check.applyied>0" class="btn  btn-success">Applied</button>
                    <button  v-if="check.applyied == 0 && loader == true " class="btn  btn-success"><i class="fa fa-cog fa-spin"></i> Appling </button>
                    <button v-if="check.applyied == 0 && loader==false && $auth.user && $auth.user.type!=3"  @click="apply()" class="btn  btn-success"> Apply Now</button>
            </div>
          </div>
          <!-- <div class="job-vacancy-wrapper">
            <div class="single-job-vacancy-wrapper">
              <i class="fas fa-briefcase"></i> Full time
            </div>
            <div class="single-job-vacancy-wrapper">
              <i class="far fa-clock"></i> Dhaka Bangladesh
            </div>
            <div class="single-job-vacancy-wrapper">
              <i class="fas fa-users"></i> Hiring 04 person
            </div>
          </div> -->
          <!-- <div class="context-wrapper">
            <div class="context-content">
              <h4>Job Context:</h4>
              <p>
                Conduct user experience through surveys and focus groups in
                collaboration with internal members and existing participants and
                focus groups in collaboration with internal members and existing
                participants, members and existing participants and focus groups
                in collaboration.
              </p>
            </div>
          </div> -->
          <div class="job-description">
            <h4>Job description</h4>
            <div style="display: flex;flex-direction: column;min-width: 0;word-wrap: break-word;">
                  <div class="details"  v-html="post.content"></div>
             </div>
          </div>
        </div>
       </b-collapse>
    </div>
</template>

<script>
export default {
  props:['post'],
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
      // this.get();
      if(this.$auth.loggedIn){
        this.checkApply();
      }
      // var self = this
      // var whole_modal = document.getElementById("whole_modal");
      // whole_modal.addEventListener("click", function(e){
      //   if(e.target.id == 'whole_modal'){
      //     self.closeModal();
      //   }
      // });
    },
   
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
        await this.$axios.get('api/check-apply/'+this.post.slug).then(response=>{
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

<style lang="scss">
.job-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.job-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.job-title {
  display: flex;
}

.logo-wrapper {
  height: 40px;
  width: 40px;
  background: #ffffff;
  border: 1px solid #bdbdbd;
  box-sizing: border-box;
  border-radius: 7px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px;
  margin-right: 10px;
}
.job-position {
  h4 {
    font-size: 16px;
    color: #0fa489;
    font-weight: 600;
    margin: 0;
  }
  p {
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: rgba(29, 49, 70, 0.8);
  }
}
.job-card-badge {
  background: #ee5d77;
  color: #fff;
  margin-left: 50px;
  width: 44px;
  height: 19px;
  font-size: 12px;
  text-align: center;
  border-radius: 2px;
}

.save-badge {
  button {
    background: #f9f9f9;
    border: 1px solid #bdbdbd;
    box-sizing: border-box;
    border-radius: 4px;
    width: 80px;
    height: 32px;
    i {
      margin-right: 10px;
    }
  }
}
.job-details-title {
  p {
    color: rgba(29, 49, 70, 0.6);
    font-size: 12px;
    margin: 0;
  }
}

.job-details-sub-title {
  h5 {
    color: #1d3146;
    font-size: 14px;
    font-weight: 500;
  }
}

.job-collapse-button {
  .btn-link {
    &:hover {
      color: #1d3146;
    }
  }
  button {
    color: #1d3146;
    font-weight: 500;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    i {
      margin-left: 10px;
    }
  }
}
.job-post-status {
  p {
    color: rgba(29, 49, 70, 0.6);
    font-size: 12px;
    margin: 0px;
  }
}
.job-card-footer {
  border-top: 1px solid #bdbdbd;
  border-bottom: 1px solid #bdbdbd;
}
// job card content
.job-card-main-content-heading {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.job-card-heading {
  p {
    color: rgba(29, 49, 70, 0.4);
    font-size: 12px;
    margin: 0px;
    h4 {
      font-weight: 600;
      font-size: 16px;
      line-height: 18px;
      color: #1d3146;
    }
  }
}
.card-expand-close-button-wrapper {
  button {
    background: #f9f9f9;
    border: 1px solid #bdbdbd;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 5px 15px;
    margin: 10px;
    color: rgba(29, 49, 70, 0.8);
    &:nth-child(odd) {
      i {
        margin-right: 10px;
      }
    }
    &:hover {
      background: #0ba88c;
      color: #fff;
      i {
        color: #fff;
      }
    }
  }
}
.job-card-heading {
  h4 {
    font-weight: 600;
    font-size: 16px;
    color: #1d3146;
  }
}
.context-content {
  h4 {
    color: #1d3146;
    font-size: 16px;
    font-weight: 600;
  }
}

.context-content {
  p {
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 21px;
    color: rgba(29, 49, 70, 0.7);
  }
}
.job-description {
  h4 {
    color: #1d3146;
    font-size: 16px;
    font-weight: 600;
  }
}
.job-description-list {
  ul {
    margin: 0;
    padding-left: 1rem;
    li {
      font-weight: 500;
      font-size: 14px;
      line-height: 21px;
      color: rgba(29, 49, 70, 0.7);
      margin: 15px 0;
    }
  }
}
// job vacancy
.single-job-vacancy-wrapper {
  color: rgba(29, 49, 70, 0.8);
  font-size: 12px;
  font-weight: 600;
  margin-right: 20px;
  i {
    color: rgba(11, 168, 140, 0.6);
    font-size: 16px;
    margin-right: 15px;
    font-weight: bold;
  }
}
.job-vacancy-wrapper {
  display: flex;
  align-items: center;
  margin: 2rem 10px 2rem 0px;
}
.job-card-main-content-wrapper {
  padding: 0px 2rem;
}
.job-condition-wrapper {
  padding: 1.5rem 0;
  .single-job-condition-wrapper {
    h4 {
      font-weight: 600;
      font-size: 14px;
      color: #1d3146;
      span {
        font-weight: normal;
      }
    }
  }
}
</style>
