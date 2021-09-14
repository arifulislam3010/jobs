<template>
    <div class="modal fade"  :class="modalOpen?'show':''" id="exampleModal"  :style="modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5  class="modal-title" id="exampleModalLabel">আবেদনকারীর বিস্তারিত</h5>
            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <p style="border-bottom:1px solid gray">ব্যক্তিগত তথ্য</p>
                </div>
                <div class="col-md-6">
                  <span><b>পূর্ণনাম: </b>{{list.name}}</span><br>
                  <span><b>পিতার নাম: </b></span>{{list.father_name}}<br>
                  <span><b>মাতার নাম: </b></span>{{list.mother_name}}<br>
                  <span><b>স্বামী/স্ত্রীরনাম: </b></span>{{list.spouse_name}}<br>
                  <span><b>জাতীয় পরিচয়পত্র নম্বর: </b>{{list.nid}}</span><br>
                  <!-- <span><b>জন্মস্থান:</b></span>{{list}}<br>  -->
                  <span><b>জন্ম তারিখ: </b>{{list.birthday}}</span><br>
                  <span><b>বৈবাহিক অবস্থা: </b><span v-if="list.personal">{{list.personal.marital_status}}</span></span><br>
                  <span><b>লিঙ্গ: </b><span v-if="list.personal">{{list.personal.sex}}</span></span><br>
                  <span><b>ধর্ম: </b><span v-if="list.personal">{{list.personal.religion}}</span></span><br>
                  
                  <span><b>উচ্চতা (মিটার): </b><span v-if="list.personal">{{list.personal.height}}</span></span><br>
                  <span><b>ওজন(কেজি): </b><span v-if="list.personal">{{list.personal.weight}}</span></span><br>
                  <span><b>পুত্রের সংখ্যা:</b><span v-if="list.personal">{{list.personal.no_son}}</span></span><br>
                  <span><b>কন্যার সংখ্যা:</b></span><span v-if="list.personal">{{list.personal.no_daughter}}</span><br>
                  <span><b>পাসপোর্ট নম্বর: </b><span v-if="list.personal">{{list.personal.passport_no}}</span></span><br>
                  <span><b>পাসপোর্ট ইস্যু তারিখ:</b> <span v-if="list.personal">{{list.personal.passport_date}}</span></span><br><br>
                </div>
                <div class="col-md-6">
                  <div>
                    <img height="100px" width="100px" v-if="list.image" :src="list.image" alt="">
                    <img height="100px" width="100px" v-else src="https://www.w3schools.com/w3css/img_avatar3.png" alt="">
                  </div>
                  <br>
                  <span><b>কাঙ্খিত চাকুরী: </b>
                      <ul>
                        <li v-for="(job,key5) in list.jobs" :key="key5">{{job.name}}</li>
                      </ul>
                  </span><br>
                  <span><b>কাঙ্খিত দেশ: </b>
                      <ul>
                        <li v-for="(country,key6) in list.countries" :key="key6">{{country.country_name}}</li>
                      </ul>
                  </span><br>
                </div>
                <div v-if="list.address2" class="col-md-6">
                  <p style="border-bottom:1px solid gray">স্থায়ী ঠিকানা</p>
                  <span><b>বিভাগ: </b>{{list.address2.division.division_name_eng}}</span><br>
                  <span><b>জেলা: </b>{{list.address2.district.district_name_eng}}</span><br>
                  <span><b>থানা/ উপজেলা: </b>{{list.address2.subdistrict.upazila_name_eng}}</span><br>
                  <span><b>ওয়ার্ড/ ইউনিয়ন: </b>{{list.address2.union.union_name_eng}}</span><br>
                  <span><b>এলাকা/ গ্রাম: </b>{{list.address2.village}}</span><br>
                  <span><b>পোস্ট অফিস: </b>{{list.address2.postoffice}}</span><br>
                  <span><b>রোডনম্বর/ পাড়া: </b>{{list.address2.street}}</span><br>
                  <span><b>ফোন: </b>{{list.address2.phone}}</span><br><br>
                </div>
                
                <div v-if="list.address3" class="col-md-6">
                  <p style="border-bottom:1px solid gray">চিঠি পাঠানোর ঠিকানা</p>
                  <span><b>বিভাগ: </b>{{list.address3.division.division_name_eng}}</span><br>
                  <span><b>জেলা: </b>{{list.address3.district.district_name_eng}}</span><br>
                  <span><b>থানা/ উপজেলা: </b>{{list.address3.subdistrict.upazila_name_eng}}</span><br>
                  <span><b>ওয়ার্ড/ ইউনিয়ন: </b>{{list.address3.union.union_name_eng}}</span><br>
                  <span><b>এলাকা/ গ্রাম: </b>{{list.address3.village}}</span><br>
                  <span><b>পোস্ট অফিস: </b>{{list.address3.postoffice}}</span><br>
                  <span><b>রোডনম্বর/ পাড়া: </b>{{list.address3.street}}</span><br>
                  <span><b>ফোন: </b>{{list.address3.phone}}</span><br><br>
                </div>
                <div class="col-md-12">
                  <p style="border-bottom:1px solid gray">নমিনী</p>
                </div>
                <div v-if="list.nominee" class="col-md-12">
                  <span><b>নমিনীর নাম: </b>{{list.nominee.name}}</span><br>
                  <span><b>সম্পর্ক: </b>{{list.nominee.relation}}</span><br>
                  <span><b>ফোন/ মোবাইল: </b>{{list.nominee.phone}}</span><br>
                  <span><b>ঠিকানা: </b></span>{{list.nominee.address}}<br>
                  <br>
                </div>
                <div class="col-md-12">
                  <p style="border-bottom:1px solid gray">শিক্ষা</p>
                </div>
                <div v-if="list.educations" class="col-md-12">
                  <div v-for="(education,key2) in list.educations" :key="key2">
                    <span><b>ডিগ্রীর নাম: </b>{{education.degree}}</span><br>
                    <span><b>পাশের সন: </b>{{education.p_year}}</span><br>
                    <span><b>শিক্ষাপ্রতিষ্ঠান/ স্কুল: </b>{{education.institute}}</span><br>
                    <span><b>শিক্ষাবোর্ড: </b>{{education.board}}</span><br>
                    <span><b>বিষয়: </b>{{education.subject}}</span><br>
                    <span><b>গ্রেড/ডিভিশান: </b>{{education.grade}}</span><br><br>
                  </div>
                </div>
                <div class="col-md-12">
                  <p style="border-bottom:1px solid gray">অভিজ্ঞতা</p>
                </div>
                <div v-if="list.experiences" class="col-md-12">
                  <div  v-for="(experience,key3) in list.experiences" :key="key3">
                    <span><b>কোম্পানী নাম: </b>{{experience.company_name}}</span><br>
                    <span><b>পদবী: </b>{{experience.post_held}}</span><br>
                    <span><b>শুরু: </b>{{experience.serve_form}}</span><br>
                    <span><b>শেষ: </b>{{experience.serve_till}}</span><br>
                    <span><b>সম্পর্কিত ব্যক্তি: </b>{{experience.contact_person}}</span><br>
                    <span><b>ফোন/ মোবাইল: </b>{{experience.phone}}</span><br>
                    <span><b>ইমেইল: </b>{{experience.email}}</span><br>
                    <span><b>দায়িত্ব: </b>{{experience.responsibility}}</span><br>
                    <span><b>অর্জন: </b>{{experience.achievement}}</span><br><br>
                  </div>
                </div>
                <div class="col-md-12">
                  <p style="border-bottom:1px solid gray">প্রশিক্ষণ</p>
                </div>
                <div v-if="list.trainings" class="col-md-12">
                  <div  v-for="(training,key3) in list.trainings" :key="key3">
                    <span><b>প্রশিক্ষণের নাম: </b>{{training.training_name}}</span><br>
                    <span><b>সময়কাল: </b>{{training.duration}}</span><br>
                    <span><b>বিস্তারিত : </b>{{training.description}}</span><br>
                    <span v-if="training.training_center"><b>প্রশিক্ষণ কেন্দ্র: </b>{{training.training_center.name}}</span><br><br>
                  </div>
                </div>
                <div class="col-md-12">
                  <p style="border-bottom:1px solid gray">ভাষা</p>
                </div>
                <div v-if="list.languages" class="col-md-12">
                  <div  v-for="(language,key4) in list.languages" :key="key4">
                    <span><b>ভাষা: </b>{{language.language.name}}</span><br>
                    <span><b>মৌখিক দক্ষতা: </b>{{language.oral_skill}}</span><br>
                    <span><b>লিখন দক্ষতা: </b>{{language.writing_skill}}</span><br><br>
                  </div>
                </div>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">বাদ দিন</button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>

export default {
  data() {
    return {
        modalOpen:false,
        list:{
          name:'',
        }
    }
  },
  methods: {
    openModal(list) {
        this.list = list
        this.modalOpen = true
    },
    CloseModal() {
        this.modalOpen = false
    }
  }
};
</script>
<style scoped>
.required{
  color:red;
}
.logo_upload{
    border: 1px solid #ccc;
    width: 100%;
    height: 90px;
    background: #eceef0;
    text-align: center;
    cursor: pointer;
}
.image_upload p{
    margin-top: 10px;
    font-size: 12px;
}

.image_upload i{
    font-size: 34px;
}
.removeImage{
   position: absolute;
    right: 13px;
    top:  14px;
    color: var(--white);
    border: 1px solid;
    border-radius: 25px;
    padding: 4px 8px;
    background-color: #fb1212f5;
    font-size: 10px;
    font-family: cursive;
}
.fitimage {
    width: 32%;
    height: 100%;
    -o-object-fit: contain;
    object-fit: contain;
    background-color: #e6e6ef;
}
.modal {
  background-color: rgb(0, 0, 0); /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}

</style>