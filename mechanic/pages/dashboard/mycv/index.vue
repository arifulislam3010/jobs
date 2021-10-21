<template>
  <div class="main-body" style="padding: 0px; padding-right: 15px;padding-bottom: 15px;">
    <div class="container" style="padding: 0px;">
      <div class="row" style="padding: 0px;">
        <div class="col-md-12 col-lg-12" style="padding: 0px;">
          <div class="job-card-layout">
            <div class="cv-top-download-wrapper">
              <div class="d-flex justify-content-end">
                <div class="cv-top-button email-btn mr-4">
                  <a href=""
                    ><img
                      src="~/assets/image/cv/mail.png"
                      class="img-fluid"
                    />Email</a
                  >
                </div>
                <div class="cv-top-button download-btn">
                  <a  @click="downloadCv()" href="#"
                    ><img
                      src="~/assets/image/cv/download-cloud.png"
                      class="img-fluid"
                    />Download</a
                  >
                </div>
              </div>
            </div>
            <!-- people info -->
            <div class="cv-people-info-wrapper">
              <div class="cv-person-content d-flex mr-5">
                <div class="cv-person-image">
                   <img   class="img-fluid" :src="list.image" v-if="list.image">
                   <img  class="img-fluid" v-else src="~/assets/image/u.png">
                </div>
                <div class="cv-person-details mt-4 pl-4">
                  <div class="cv-person-name">
                    <h2>{{list.name}}</h2>
                  </div>
                  <!-- <div class="cv-rating-content-wrapper d-flex align-items-center">
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
                  </div> -->
                  <div class="cv-people-contact-info-wrapper">
                    <ul>
                      <li>
                        <img
                          src="~/assets/image/cv/phone-call.png"
                          alt=""
                        />Contact : <span>{{list.phone}}</span>
                      </li>
                      <li>
                        <img
                          src="~/assets/image/cv/mailBlack.png"
                          alt=""
                        />Email :
                        <span>{{list.email}}</span>
                      </li>
                      <li>
                        <img
                          src="~/assets/image/cv/map-pin.png"
                          alt=""
                        /> <span v-if="list.present_address"> Location : {{list.present_address.village}}, {{list.present_address.postoffice}}, {{list.present_address.subdistrict.upazila_name_eng}}, {{list.present_address.district.district_name_eng}}</span>
                      </li>
                     
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <!-- experiance -->
            <div class="experinance-block-wrapper mt-4">
              <div
                class="cv-block-header d-flex justify-content-between align-items-center"
              >
                <div class="cv-block-title">
                  <h2>Experiance</h2>
                </div>
                <!-- <div class="cv-block-edit-btn">
                  <a href=""
                    ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                  >
                </div> -->
              </div>
              <div class="experiance-main-block-wrapper">
                <div class="row">
                  <div class="col-md-4 col-lg-4" v-for="(experience,key) in list.experiences" :key="key">
                    <div class="experiance-single-block">
                      <div class="experiance-single-block-header">
                        <h2>{{experience.company_name}}</h2>
                      </div>
                      <div class="experiance-single-block-item">
                        <div>Designation : {{experience.post_held}}</div>
                        <div>Joining Date : {{experience.serve_form.substr(0,4)}}</div>
                        <div>Resign Date : {{experience.serve_till.substr(0,4)}}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- education -->
            <div
              class="cv-block-header d-flex justify-content-between align-items-center"
            >
              <div class="cv-block-title">
                <h2>Education</h2>
              </div>
              <!-- <div class="cv-block-edit-btn">
                <a href=""
                  ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                >
              </div> -->
            </div>
            <div class="cv-border-block">
              <div class="row">
                <div class="col-md-6"  v-for="(education,key) in list.educations" :key="key">
                  <div class="cv-single-content-block">
                    <div class="cv-single-content-block-title">
                      <h2>{{education.institute}}</h2>
                    </div>
                    <div class="cv-single-content-block-content">
                      <p>
                        <span>Year: {{education.p_year}}</span><span> Degree: {{education.degree}}</span> Group :
                        <span>{{education.subject}}</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- training block -->
            <div class="cv-block-header d-flex justify-content-between align-items-center" >
              <div class="cv-block-title">
                <h2>Training</h2>
              </div>
              <!-- <div class="cv-block-edit-btn">
                <a href=""
                  ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                >
              </div> -->
            </div>
            
            <div class="cv-border-block">
              <div class="row">
                <div class="col-md-6" v-for="(training,key) in list.trainings" :key="key">
                  <div class="cv-single-content-block">
                    <div class="cv-single-content-block-title">
                      <h2>{{training.training_name}}</h2>
                    </div>
                    <div class="cv-single-content-block-content">
                      <p>
                        <span>Duration : {{training.duration}}</span
                        ><span>Institute : {{training.training_center.name}} </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Language -->
            <div class="cv-block-header d-flex justify-content-between align-items-center" >
              <div class="cv-block-title">
                <h2>Language</h2>
              </div>
              <!-- <div class="cv-block-edit-btn">
                <a href=""
                  ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                >
              </div> -->
            </div>
            
            <div class="cv-border-block">
              <div class="row">
                <div class="col-md-6" v-for="(language,key) in list.languages" :key="key">
                  <div class="cv-single-content-block">
                    <div class="cv-single-content-block-title">
                      <h2>{{language.language.name}}</h2>
                    </div>
                    <div class="cv-single-content-block-content">
                      <p>
                        <span>Oral skill: {{language.oral_skill}}</span
                        ><span> Writing skill: {{language.writing_skill}}</span>
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
              <div class="cv-block-edit-btn">
                <a href=""
                  ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                >
              </div>
            </div>
            <div class="cv-border-block">
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="cv-single-content-block">
                    <div class="personal-info cv-single-content-block-content">
                      <table>
                        <tr>
                          <td>Name</td>
                          <td>: {{list.name}}</td>
                        </tr>
                        <tr>
                          <td>Fathers Name</td>
                          <td>: {{list.father_name}}</td>
                        </tr>
                        <tr>
                          <td>Mothers Name</td>
                          <td>: {{list.mother_name}}</td>
                        </tr>
                        <tr>
                          <td>Birth Date</td>
                          <td>: {{list.birthday}}</td>
                        </tr>
                        <tr>
                          <td>Gender</td>
                          <td>: {{list.gender}}</td>
                        </tr>
                        <tr>
                          <td>NID Number</td>
                          <td>: {{list.nid}}</td>
                        </tr>
                        <tr>
                          <td>Nationality</td>
                          <td>: {{list.nationality}}</td>
                        </tr>
                        <tr>
                          <td>Relegious</td>
                          <td>: {{list.religion}}</td>
                        </tr>
                        <tr>
                          <td>Maretial Status</td>
                          <td>: {{list.m_status}}</td>
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
                          <td>: {{list.passport_number}}</td>
                        </tr>
                        <tr>
                          <td>Passport Issue Date.</td>
                          <td>: {{list.passport_issue_date}}</td>
                        </tr>
                        <tr>
                          <td>Expected Indusry</td>
                          <td>: {{list.father_name}}</td>
                        </tr>
                        <!-- <tr>
                          <td>Expected Country</td>
                          <td>: {{list.father_name}}</td>
                        </tr> -->
                        <!-- <tr>
                          <td>Prefession</td>
                          <td>: {{list.father_name}}</td>
                        </tr> -->
                        <!-- <tr>
                          <td>NID Number</td>
                          <td>: {{list.father_name}}</td>
                        </tr> -->
                        <tr>
                          <td>Weight</td>
                          <td>: {{list.weight}}</td>
                        </tr>
                        <tr>
                          <td>Height</td>
                          <td>: {{list.height}}</td>
                        </tr>
                        <!-- <tr>
                          <td>Maretial Status</td>
                          <td>: {{list.father_name}}</td>
                        </tr> -->
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- address -->
            <div
              class="cv-block-header d-flex justify-content-between align-items-center"
            >
              <div class="cv-block-title">
                <h2>Address</h2>
              </div>
              <div class="cv-block-edit-btn">
                <a href=""
                  ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                >
              </div>
            </div>
            <div class="address-block cv-border-block">
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="cv-single-content-block">
                    <div class="cv-single-content-block-title">
                      <h2>Present Address</h2>
                    </div>
                   
                    <div v-if="list.present_address" class="addressInfo cv-single-content-block-content">
                      <p>State <span>: {{list.present_address.division.division_name_bng}}</span></p>
                      <p>Distrcit <span>: {{list.present_address.district.district_name_bng}}</span></p>
                      <p>Thana <span>:  {{list.present_address.subdistrict.upazila_name_bng}}</span></p>
                      <p>Area/Village <span>: {{list.present_address.village}}</span></p>
                      <p>House/Road <span>: {{list.present_address.street}}</span></p>
                      <p>Post Code <span>: {{list.present_address.postoffice}}</span></p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6">
                  <div class="cv-single-content-block">
                    <div class="cv-single-content-block-title">
                      <h2>Permanent Address</h2>
                    </div>
                    <div v-if="list.permanent_address" class="addressInfo cv-single-content-block-content">
                      <p>State <span>: {{list.permanent_address.division.division_name_bng}}</span></p>
                      <p>Distrcit <span>: {{list.permanent_address.district.district_name_bng}}</span></p>
                      <p>Thana <span>:  {{list.permanent_address.subdistrict.upazila_name_bng}}</span></p>
                      <p>Area/Village <span>: {{list.permanent_address.village}}</span></p>
                      <p>House/Road <span>: {{list.permanent_address.street}}</span></p>
                      <p>Post Code <span>: {{list.permanent_address.postoffice}}</span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- copyright footer -->
            <div class="cv-footer-wrapper mt-1">
              <div
                class="cv-footer-content-wrapper d-flex justify-content-between align-items-center"
              >
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
</template>
<script>
export default {
  layout: 'dashboard',
  data() {
    return {
      modalOpen: false,
      list: {}
    }
  },
  mounted(){
      this.getcv();
  },
  methods: {
    getcv(){
        this.$axios.get('api/cv').then(response => {
               this.list = response.data
        })
    },
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
<style lang="scss" scoped>
$cv-primary: #0ba88c;
$cv-font: #1d3146;
.main-body {
  // margin-top: 100px;
}
.job-card-layout {
  background: #fdfdfd;
  border: 1px solid #bdbdbd;
  box-sizing: border-box;
  box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  padding: 10px;
  margin-bottom: 1rem;
  .cv-top-button {
    padding: 5px 10px;
    border-radius: 4px;
    a {
      color: #fff;
      font-size: 14px;
      font-weight: normal;
      img {
        margin-right: 8px;
      }
    }
  }
  .email-btn {
    background: #a0a0a0;
  }
  .download-btn {
    background: $cv-primary;
  }
  //   people info
  .cv-people-info-wrapper {
    .cv-person-content {
      .cv-person-image {
        height: 184px;
        width: 154px;
        img {
          border-radius: 10px;
        }
      }
    }
    .cv-rating-content-wrapper {
      .position-badge {
        background: $cv-primary;
        color: #fff;
        border-radius: 10px;
        padding: 5px 1rem;
        margin-right: 16px;
      }
      .blood-group-badge {
        background: #eae000;
        padding: 5px 10px;
        color: #515151;
        margin-right: 16px;
        border-radius: 10px;
        font-weight: bold;
      }
      .rating {
        ul {
          margin: 0;
          display: flex;
          list-style: none;
          padding: 0;
          li {
            i.far.fa-star {
              color: #a0a0a0 !important;
            }
            font-size: 24px;
            margin-right: 10px;
            i {
              color: #fac300;
            }
            &:last-child {
              margin-right: 0px;
            }
          }
        }
      }
    }
    .cv-people-contact-info-wrapper {
      ul {
        margin: 0px;
        padding: 0px;
        list-style: none;
        li {
          margin: 10px 0;
          color: $cv-font;
          font-size: 14px;
          img {
            margin-right: 10px;
          }
        }
      }
    }
  }
}
.cv-block-header {
  margin: 10px 0;
  padding: 0 1rem;
  .cv-block-title {
    h2 {
      font-size: 18px;
      margin: 0px;
    }
  }
  .cv-block-edit-btn {
    a {
      background: $cv-primary;
      font-size: 14px;
      color: #fff;
      padding: 5px 10px;
      border-radius: 4px;
      img {
        margin-right: 10px;
      }
    }
  }
}

.experiance-main-block-wrapper {
  .experiance-single-block-header h2 {
    font-size: 16px;
  }
  .experiance-single-block-item {
    div {
      font-size: 12px;
      padding-bottom: 5px;
    }
  }
  .experiance-single-block {
    padding: 15px 0;
  }
}
.experiance-main-block-wrapper {
  border-top: 1px solid #c4c4c4;
  border-bottom: 1px solid #c4c4c4;
}
.experiance-main-block-wrapper {
  .row {
    .col-lg-4 {
      border-right: 1px solid #c4c4c4;
      &:last-child {
        border: none;
      }
    }
  }
}
// global block
.cv-single-content-block {
  .cv-single-content-block-title {
    h2 {
      font-size: 16px;
    }
  }
  .cv-single-content-block-content {
    p {
      font-size: 12px;
    }
  }
}
.cv-border-block {
  .row {
    margin: 0px;
  }
  .col-md-6,
  .col-lg-6 {
    border-top: 1px solid #c4c4c4;
    border-bottom: 1px solid #c4c4c4;
    border-right: 1px solid #c4c4c4;
    padding: 1rem;
    &:last-child {
      border-right: 0;
    }
  }
}
.cv-footer-wrapper {
  padding: 2rem 1rem;
  .cv-copyright {
    p {
      font-size: 12px;
      a {
        color: $cv-primary;
        font-weight: 700;
      }
    }
  }
  .cv-signature {
    border-top: 2px solid #c4c4c4;
    padding: 5px;
  }
  .cv-border {
    font-size: 18px;
  }
}

.personal-info {
  p {
    span {
      //   padding-left: 3rem;
    }
  }
}

.address-block {
  .col-md-6,
  .col-lg-6 {
    border-bottom: none;
  }
}
// personal info table
.personal-info {
  table {
    border-collapse: separate;
    border-spacing: 0 10px;
    tr {
      td {
        font-size: 12px;
        &:first-child {
          padding-right: 3rem;
        }
      }
    }
  }
}
.addressInfo {
}
</style>
