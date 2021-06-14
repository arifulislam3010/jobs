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
        <div class="modal-body">
          <div class="">
            <div id="cv" class="instaFade">
              <div class="mainDetails">
                <div id="headshot">
                  <img :src="list.image" alt="Alan Smith" />
                </div>

                <div id="contactDetails">
                  <p>{{list.name}}</p>
                  <ul style="margin:0;padding:0">
                    <li v-if="list.email">ইমেইল: {{list.email}}</li>
                    <li v-if="list.phone">মোবাইল: {{list.phone}}</li>
                    <li>এনআইডি: {{list.nid}}</li>
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

                    <div v-if="list.permanent_address" class="sectionContent">
                      <ul class="address">
                        <li>
                          <b>বিভাগ:</b>{{list.permanent_address.division.division_name_eng}}
                        </li>
                        <li>
                          <b>জেলা:</b> {{list.permanent_address.district.district_name_eng}}
                        </li>
                        <li>
                          <b>উপজেলা:</b>{{list.permanent_address.subdistrict.upazila_name_eng}}
                        </li>
                        <li>
                          <b>ইউনিয়ন:</b>{{list.permanent_address.union.union_name_eng}}
                        </li>
                      </ul>
                      <ul class="address ">
                        <li>
                          <b>গ্রাম/ মহল্লা:</b>{{list.permanent_address.village}}
                        </li>
                        <li>
                          <b>রাস্তার নাম:</b>
                          {{list.permanent_address.street}}
                        </li>
                        <li>
                          <b>পোস্ট অফিস:</b>{{list.permanent_address.postoffice}}
                        </li>
                        <li>
                          <b>ফোন:</b>{{list.permanent_address.phone}}
                        </li>
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

                    <div v-if="list.present_address" class="sectionContent">
                      <ul class="address">
                        <li>
                          <b>বিভাগ:</b>
                          {{list.present_address.division.division_name_eng}}
                        </li>
                        <li>
                          <b>জেলা:</b>
                          {{list.present_address.district.district_name_eng}}
                        </li>
                        <li>
                          <b>উপজেলা:</b>
                          {{list.present_address.subdistrict.upazila_name_eng}}
                        </li>
                        <li>
                          <b>ইউনিয়ন:</b>
                          {{list.present_address.union.union_name_eng}}
                        </li>
                      </ul>
                      <ul class="address">
                        <li>
                          <b>গ্রাম/ মহল্লা:</b>
                          {{list.present_address.village}}
                        </li>
                        <li>
                          <b>রাস্তার নাম:</b>
                          {{list.present_address.street}}
                        </li>
                        <li>
                          <b>পোস্ট অফিস:</b>
                          {{list.present_address.postoffice}}
                        </li>
                        <li>
                          <b>ফোন:</b>
                          {{list.present_address.phone}}
                        </li>
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
                    <article v-for="(experience,key) in list.experiences" :key="key">
                      <h2>{{experience.post_held}}, {{experience.company_name}}</h2>
                      <p class="subDetails">{{experience.serve_form}} -- {{experience.serve_till}}</p>
                      <p
                        v-if="experience.responsilbility"
                        style="margin-bottom:5px !important;"
                      >{{experience.responsilbility}}</p>
                      <p v-if="experience.achievement">{{experience.achievement}}</p>
                    </article>
                  </div>
                  <div class="clear"></div>
                </section>

                <section>
                  <div class="sectionTitle">
                    <h1>গৃহীত প্রশিক্ষণ</h1>
                  </div>

                  <div class="sectionContent">
                    <article v-for="(training,key) in list.trainings" :key="key">
					<h2>{{training.training_name}}, {{training.name}}</h2>
					<p class="subDetails">{{training.time_tense}}</p>
					<p v-if="training.description" style="margin-bottom:5px !important;">{{training.description}}</p>
                    </article>
                  </div>
                  <div class="clear"></div>
                </section>

                <section>
                  <div class="sectionTitle">
                    <h1>কাঙ্খিত চাকুরী</h1>
                  </div>

                  <div class="sectionContent">
                    <ul class="address">
                      <span v-for="(job,key) in list.jobs" :key="key"><li v-if="key%2 == 0">{{job.name}}</li></span>
                    </ul>
                    <ul class="address">
                      <span v-for="(job,key) in list.jobs" :key="key"><li v-if="key%2 == 1">{{job.name}}</li></span>
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
                      <span v-for="(country,key) in list.countries"
                        :key="key"><li v-if="key%2 == 0">{{country.country_name}}</li></span>
                    </ul>
                    <ul class="address">
                      <span v-for="(country,key) in list.countries"
                        :key="key"><li v-if="key%2 == 1">{{country.country_name}}</li></span>
                    </ul>
                  </div>
                  <div class="clear"></div>
                </section>
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
                </section>-->

                <section>
                  <div class="sectionTitle">
                    <h1>শিক্ষাগত যোগ্যতা</h1>
                  </div>

                  <div class="sectionContent">
                    <article v-for="(education,key) in list.educations" :key="key">
                      <h2>{{education.institute}}</h2>
                      <p class="subDetails">{{education.degree}}</p>
                      <p class="subDetails2">বিষয়: {{education.subject}}</p>
                      <p class="subDetails2">গ্রেড/ডিভিশান: {{education.grade}}</p>
                      <p class="subDetails2">পাশের সন: {{education.p_year}}</p>
                    </article>
                  </div>
                  <div class="clear"></div>
                </section>
                <section>
                  <div class="sectionTitle">
                    <h1>ভাষাগত দক্ষতা</h1>
                  </div>

                  <div class="sectionContent">
                    <article v-for="(language,key) in list.languages" :key="key">
                      <h2>{{language.language.name}}</h2>
                      <p class="subDetails2">মৌখিক দক্ষতা: {{language.oral_skill}}</p>
                      <p class="subDetails2">লেখার দক্ষতা: {{language.writing_skill}}</p>
                    </article>
                  </div>
                  <div class="clear"></div>
                </section>
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
      window.open('http://localhost:8000/api/download-cv/'+this.list.id)
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
.required {
  color: red !important;
}
.logo_upload {
  border: 1px solid #ccc !important;
  width: 100% !important;
  height: 90px !important;
  background: #eceef0 !important;
  text-align: center !important;
  cursor: pointer !important;
}
.image_upload p {
  margin-top: 10px !important;
  font-size: 12px !important;
}

.image_upload i {
  font-size: 34px !important;
}
.removeImage {
  position: absolute !important;
  right: 13px !important;
  top: 14px !important;
  color: var(--white) !important;
  border: 1px solid !important;
  border-radius: 25px !important;
  padding: 4px 8px !important;
  background-color: #fb1212f5 !important;
  font-size: 10px !important;
  /* font-family: cursive !important; */
}
.fitimage {
  width: 32% !important;
  height: 100% !important;
  -o-object-fit: contain !important;
  object-fit: contain !important;
  background-color: #e6e6ef !important;
}
.modal {
  background-color: rgb(0, 0, 0) !important; /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4) !important; /* Black w/ opacity */
}



article,
details,
section {
  display: block !important;
}


.clear {
  clear: both !important;
}

p {
  font-size: 1em !important;
  line-height: 1.4em !important;
  margin-bottom: 20px !important;
  color: #444 !important;
}

#cv {
  width: 90% !important;
  background: #f3f3f3 !important;
  margin: 0 auto !important;
}

.mainDetails {
  padding: 25px 35px !important;
  border-bottom: 2px solid #cf8a05 !important;
  width: 100% !important;
  /*background: #ededed !important;*/
}

#name h1 {
  font-size: 2.5em !important;
  font-weight: 700 !important;
  /* font-family: 'Rokkitt', Helvetica, Arial, sans-serif !important; */
  margin-bottom: -6px !important;
}

#name h2 {
  font-size: 2em !important;
  margin-left: 2px !important;
  /* font-family: 'Rokkitt', Helvetica, Arial, sans-serif !important; */
}

#mainArea {
  padding: 0 40px !important;
}

#headshot {
  width: 17% !important;
  float: left !important;
}

#headshot img {
  width: 100% !important;
  height: auto !important;
  /* -webkit-border-radius: 50px !important;
  border-radius: 50px !important; */
}

#name {
  width: 40% !important;
  float: left !important;
  margin-left: 20px !important;
}

#contactDetails {
  width: calc(80% - 30px) !important;
  float: left !important;
  margin-left: 22px !important;
}
#contactDetails p {
  font-size: 2em !important;
  /*font-weight: 700 !important;*/
  /* font-family: 'examplefont' !important; */
  margin-bottom: -6px !important;
}

#contactDetails ul {
  list-style-type: none !important;
  font-size: 0.9em !important;
  margin-top: 2px !important;
}

#contactDetails ul li {
  margin-bottom: 3px !important;
  color: #444 !important;
}

#contactDetails ul li a,
a[href^='tel'] {
  color: #444 !important;
  text-decoration: none !important;
  -webkit-transition: all 0.3s ease-in !important;
  -moz-transition: all 0.3s ease-in !important;
  -o-transition: all 0.3s ease-in !important;
  -ms-transition: all 0.3s ease-in !important;
  transition: all 0.3s ease-in !important;
}

#contactDetails ul li a:hover {
  color: #cf8a05 !important;
}

section {
  border-top: 1px solid #dedede !important;
  padding: 20px 0 0 !important;
}

section:first-child {
  border-top: 0 !important;
}

section:last-child {
  padding: 20px 0 10px !important;
}

.sectionTitle {
  float: left !important;
  width: 25% !important;
}

.sectionContent {
  float: right !important;
  width: 72.5% !important;
}

.sectionTitle h1 {
  /* font-family:  sans-serif !important; */
  /* font-style: italic !important; */
  font-size: 1.5em !important;
  color: #cf8a05 !important;
}

.sectionContent h2 {
  /* font-family: 'Rokkitt', Helvetica, Arial, sans-serif !important; */
  font-size: 1.5em !important;
  margin-bottom: -2px !important;
}

.subDetails {
  font-size: 0.8em !important;
  font-style: italic !important;
  margin-bottom: 5px !important;
}

.subDetails2 {
  font-size: 1em !important;
  margin-bottom: 3px !important;
}

.keySkills {
  list-style-type: none !important;
  -moz-column-count: 3 !important;
  -webkit-column-count: 3 !important;
  column-count: 3 !important;
  margin-bottom: 20px !important;
  font-size: 1em !important;
  color: #444 !important;
}

.keySkills ul li {
  margin-bottom: 3px !important;
}

.address {
  /* width: 40%  !important;
  float: left !important; */
  list-style-type: none !important;
  -moz-column-count: 3 !important;
  -webkit-column-count: 3 !important;
  column-count: 3 !important;
  margin-bottom: 20px !important;
  font-size: 1em !important;
  color: #444 !important;
  margin-left: 0;
  padding-left: 0;
}

.address ul li {
  margin-bottom: 3px !important;
}
</style>
</style>