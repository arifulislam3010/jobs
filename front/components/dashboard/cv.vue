<template>
  <div
    class="modal fade"
    :class="modalOpen?'show':''"
    id="exampleModal"
    :style="modalOpen?'display: block !important; overflow: scroll !important; padding-right: 17px !important;':''"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button @click="downloadCv()" class="btn-sm btn-success"><i class="fas fa-file-pdf"></i> ডাউনলোড</button>&nbsp;&nbsp;
          <button  class="btn-sm btn-success"><i class="fas fa-paper-plane"></i> ইমেইল</button>
          <button
            type="button"
            class="close"
            @click="CloseModal"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div style="overflow-x: scroll;" class="modal-body">
          <div class="container-custom">
            <div style="height: 70px;width: 100%;background-color: #9942da;position: relative;">
              <img style="margin-top:-40px;height: 160px;width:155px;border: 3px solid #9942da;margin-left: calc(40% - 155px)" :src="list.image" v-if="list.image">
              <img style="margin-top:-40px;height: 160px;width:155px;border: 3px solid #9942da;margin-left: calc(40% - 155px)" v-else src="http://api.immigration.orangebd.com/cv_img/blank-face.jpg">
              <span style="font-size: 22px;color:#fff;font-weight: bold;position: absolute;margin-left: 5%;top: 20px">{{list.name}}</span>
            </div>
            <div  class="left">
              <span style="font-size:22px;font-weight: bold">যোগাযোগ</span>
              <div style="width:100%;height: 12px;"></div>
              <div style="width:100%">
                <div style="width: 10%;">
                  <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/pointer.jpg">
                </div>
                <div  v-if="list.present_address" style="font-size:14px;margin-top: -18px;width: 90%;margin-left: 27px">
                  <span style="font-size:14px;">{{list.present_address.village}}, {{list.present_address.postoffice}}, {{list.present_address.subdistrict.upazila_name_eng}}, {{list.present_address.district.district_name_eng}}</span>
                </div>
                <div class="clear"></div>
              </div>
              <div class="clear"></div>
              <div  style="width:100%;height: 10px;"></div>
              <div v-if="list.phone" style="width:100%">
                <div>
                  <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/phone.jpg">
                </div>
                <div style="font-size:14px;margin-top: -18px">
                  <span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{list.phone}}</span>
                </div>
              </div>
              <div v-if="list.phone" style="width:100%;height: 10px;"></div>
              <div v-if="list.present_address" style="width:100%">
                <div v-if="list.present_address.phone">
                  <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/phone.jpg">
                </div>
                <div v-if="list.present_address.phone" style="font-size:14px;margin-top: -18px">
                  <span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{list.present_address.phone}}</span>
                </div>
                <div class="clear"></div>
                <div v-if="list.present_address.phone" style="width:100%;height: 10px;"></div>
              </div>
              <div class="clear"></div>
              <div v-if="list.email" style="width:100%">
                <div>
                  <img style="width:17px;height:18px" src="http://api.immigration.orangebd.com/cv_img/mail.jpg">
                </div>
                <div style="font-size:14px;margin-top: -18px">
                  <span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{list.email}}</span>
                </div>
              </div>
              <div class="clear"></div>
              <div style="width:100%;height: 20px;"></div>
              <span style="font-size:22px;font-weight: bold">শিক্ষাগত যোগ্যতা</span>
              <div style="width:100%;height: 12px;"></div>
              <div v-for="(education,key) in list.educations" :key="key" style="width: 100%">
                <div style="width: 80%;float: left">
                  <span style="font-size:14px">{{education.institute}}</span><br>
                  <span style="font-size:12px">{{education.degree}}, {{education.subject}}</span>
                </div>
                <div style="width: 20%;float: left;">
                  <span style="font-size:14px">{{education.p_year}}</span>
                </div>
                <div class="clear"></div>
                <div style="width:100%;height: 10px;"></div>
              </div>
              <div v-if="!list.educations" class="clear"></div>
              <div v-if="!list.educations" style="width:100%;height: 10px;"></div>
              <div style="width:100%;height: 12px;"></div>
              <div v-if="list.total>=3" style="width:100%">
                <span style="font-size:22px;font-weight: bold">ভাষাগত দক্ষতা </span>
              </div>
              <div v-if="list.total>=3" style="width:100%;height: 12px;"></div>
              <div v-if="list.total>=3" v-for="(language,key) in list.languages" :key="key" style="width: 100%;float: left">
                <span style="font-size:14px">{{language.language.name}}</span><br>
                <span style="font-size:12px">লিখন দক্ষতা: {{language.oral_skill}}</span><br>
                <span style="font-size:12px">পঠন দক্ষতা: {{language.writing_skill}}</span>
                <div class="clear"></div>
                <div style="width:100%;height: 10px;"></div>
              </div>
            </div>
            <div class="right">
              <div style="margin:0;width: 100%;">
                <div style="width:92%;margin-left: 8%;">
                  <span style="font-size:22px;font-weight: bold">চাকুরীর অভিজ্ঞতা</span>
                </div>
              </div>
              <div  style="width:100%;height: 12px;"></div>
              <div class="right-child" style="margin:0;width: 100%;border-left: 2px solid #eef0f2;height:100%;">
                <div style="width:92%;margin-left: 8%;">
                  <div style="width: 100%" v-for="(experience,key) in list.experiences" :key="key" >
                    <div style="width: 78%;float: left">
                      <span style="font-size:14px">{{experience.post_held}}</span><br>
                      <span style="font-size:14px">{{experience.company_name}}</span>
                    </div>
                    <div style="width: 20%;float: left;">
                      <span style="font-size:14px">{{experience.serve_form.substr(0,4)}}-{{experience.serve_till.substr(0,4)}}</span>
                    </div>
                    <div class="clear"></div>
                    <div style="width: 98%;float: left;text-align: justify;">
                      <div v-if="experience.responsibility" style="height:5px"></div>
                      <span v-if="experience.responsibility" style="text-align: justify;font-size:12px">{{experience.responsibility}}</span>
                      <div v-if="experience.achievement" style="height:5px"></div>
                      <span v-if="experience.achievement" style="text-align: justify;font-size:12px;">{{experience.achievement}}</span>
                    </div>
                    <div class="clear"></div>
                    <div style="width:100%;height: 10px;"></div>
                  </div>
                  <div class="clear"></div>
                  <div v-if="!list.experiences" style="width:100%;height: 10px;"></div>
                  <div style="width:100%;height: 12px;"></div>
                  <div style="width:100%">
                    <span style="font-size:22px;font-weight: bold">গৃহীত প্রশিক্ষণ</span>
                  </div>
                  <div style="width:100%;height: 12px;"></div>
                  <div v-for="(training,key) in list.trainings" :key="key" style="width: 100%">
                    <div style="width: 78%;float: left">
                      <span style="font-size:14px">{{training.training_name}}</span><br>
                      <span style="font-size:12px">{{training.training_center.name}}</span>
                    </div>
                    <div style="width: 20%;float: left;">
                      <span style="font-size:14px">{{training.duration}}</span>
                    </div>
                    <div class="clear"></div>
                    <div v-if="training.description" style="height:5px"></div>
                      <div   style="width: 98%;float: left;text-align: justify;">
                      <span  style="text-align: justify;font-size:12px">{{training.description}}</span>
                    </div>
                    <div class="clear"></div>
                    <div style="width:100%;height: 10px;"></div>
                  </div>
                  <div class="clear"></div>
                  <div v-if="!list.trainings" style="width:100%;height: 10px;"></div>
                  <div style="width:100%;height: 12px;"></div>
                  <div v-if="list.total<=2" style="width:100%">
                    <span style="font-size:22px;font-weight: bold">ভাষাগত দক্ষতা </span>
                  </div>
                  <div v-if="list.total<=2" style="width:100%;height: 12px;"></div>
                  <div v-if="list.total<=2" v-for="(language,key) in list.languages" :key="key" style="width: 100%;float: left">
                    <span style="font-size:14px">{{language.language.name}}</span><br>
                    <span style="font-size:12px">লিখন দক্ষতা: {{language.oral_skill}}</span><br>
                    <span style="font-size:12px">পঠন দক্ষতা: {{language.writing_skill}}</span>
                    <div class="clear"></div>
                    <div style="width:100%;height: 10px;"></div>
                  </div>
                </div>
                <div class="clear"></div>
                <div style="height:100px;"></div>
              </div>
            </div>
          </div> 
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="CloseModal"
            data-dismiss="modal"
          >বাদ দিন</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      modalOpen: false,
      list: {}
    }
  },
  methods: {
    openModal(list) {
      this.list = list
      this.modalOpen = true
    },
    CloseModal() {
      this.modalOpen = false
    },
    downloadCv() {
      window.open(process.env.LARAVEL_ENDPOINT+'/api/download-cv/'+this.list.id)
      // var FileSaver = require('file-saver') !important;

      // this.axios.get('api/test-xyz',{responseType: 'arraybuffer'}).then(response=>{
      //   var blob = new Blob([response.data], {type: "text/plain !important;charset=utf-8"}) !important;
      //   FileSaver.saveAs(blob, "hello.pdf") !important;
      // })
    }
  }
}
</script>
<style scoped>

.modal {
  background-color: rgb(0, 0, 0) !important; /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4) !important; /* Black w/ opacity */
}

html,
body,.container-custom,.right,.right-child {
  height: 100%;
}

.container-custom{
  height: 100%;
  width:720px;
  margin: 50px auto;
}
.left{
  width:38%;
  float: left;
  margin-left:2%;
  height: 100%;
  margin-top: 3.2%;
}
.right{
  width:60%;
  float: left;
  margin-top: 3.2%;
}
.clear {clear: both;}

</style>