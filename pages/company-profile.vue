<template>
  <div class="main-body">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4 col-lg-4">
          <JobFilter />
        </div>
        <div class="col-md-8 col-lg-8">
          <div class="company-profile-layout">
            <div class="company-profile-cover profile-cover-bg">
              <!-- top btn -->
              <div class="cv-block-edit-btn">
                <a href=""
                  ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                >
              </div>
              <div class="company-profile-main-content-wrapper d-flex ">
                <div class="compnay-profile-logo mr-4">
                  <img
                    src="~/assets/image/company-profile/brandLogo.png"
                    class="img-fluid"
                  />
                </div>
                <div class="comapny-profile-content">
                  <div class="company-name">Mitsubishi Motors</div>
                  <div class="tag-badge-wrapper d-flex align-items-center">
                    <div class="tag-badge">Automobile</div>
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
                  <div class="email-location-wrapper d-flex align-items-center">
                    <div class="email-wrapper mr-3">
                      <img
                        src="~/assets/image/company-profile/email.png"
                        alt=""
                      />
                      Email : company@gmail.com
                    </div>
                    <div class="location-wrapper">
                      <img
                        src="~/assets/image/company-profile/map-pin.png"
                        alt=""
                      />
                      Location : Mohammadpur
                    </div>
                  </div>
                  <div class="job-posted">
                    <a href="">13 jobs posted</a>(View all jobs by this company)
                  </div>
                </div>
              </div>
            </div>
            <div class="company-profile-body">
              <!-- about company -->
              <div
                class="company-profile-header d-flex justify-content-between align-items-center"
              >
                <div class="company-profile-title">
                  <h2>About Company</h2>
                </div>
                <div class="company-profile-edit-btn">
                  <a href=""
                    ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                  >
                </div>
              </div>
              <div class="about-content-wrapper">
                <p>
                  There are many variations of passages of Lorem Ipsum
                  available, but the majority have suffered alteration in some
                  form, by injected humour, or randomised words which don't look
                  even slightly believable. If you are going to use a passage of
                  Lorem Ipsum, you need to be sure there isn't anything
                  embarrassing hidden in the middle of text.
                </p>
                <br />
                <p>
                  There are many variations of passages of Lorem Ipsum
                  available, but the majority have suffered alteration in some
                  form, by injected humour, or randomised words which don't look
                  even slightly believable.
                </p>
              </div>
              <!-- gallery block -->
              <div
                class="company-profile-header d-flex justify-content-between align-items-center"
              >
                <div class="company-profile-title">
                  <h2>Gallery</h2>
                </div>
                <div class="company-profile-edit-btn">
                  <a href=""
                    ><img src="~/assets/image/cv/edit.png" alt="image" />Edit</a
                  >
                </div>
              </div>
              <!-- gallery block -->
              <div class="row">
                <div class="col-md-4 col-lg-4">
                  <div class="company-profile-single-image-block">
                    <img
                      src="~/assets/image/company-profile/4.png"
                      alt="image"
                      class="img-fluid"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-lg-4">
                  <div class="company-profile-single-image-block">
                    <img
                      src="~/assets/image/company-profile/1.png"
                      alt="image"
                      class="img-fluid"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-lg-4">
                  <div class="company-profile-single-image-block">
                    <img
                      src="~/assets/image/company-profile/2.png"
                      alt="image"
                      class="img-fluid"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-lg-4">
                  <div class="company-profile-single-image-block">
                    <img
                      src="~/assets/image/company-profile/4.png"
                      alt="image"
                      class="img-fluid"
                    />
                  </div>
                </div>
                <div class="col-md-4 col-lg-4">
                  <div class="company-profile-single-image-block">
                    <img
                      src="~/assets/image/company-profile/3.png"
                      alt="image"
                      class="img-fluid"
                    />
                  </div>
                </div>
              </div>
              <!-- copyright -->
              <div class="cv-copyright">
                <p>Powered by <a href="">Mechanic chai</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import JobFilter from '~/components/customDesign/JobFilter/JobFilter.vue'
export default {
  layout: 'customDesign',
  components: {
    JobFilter
  }
}
</script>

<style lang="scss">
$cv-primary: #0ba88c;
$cv-font: #1d3146;
.main-body {
  margin-top: 100px;
}
.profile-cover-bg {
  background: url('../assets/image/company-profile/car.png');
  background-size: cover;
  background-position: center;
  position: relative;
  z-index: 2;
  border-top-right-radius: 10px;
  border-top-left-radius: 10px;
  &::after {
    position: absolute;
    height: 100%;
    width: 100%;
    content: '';
    left: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: -1;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
  }
}
.cv-block-edit-btn {
  display: flex;
  justify-content: end;
  padding: 1rem;
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
.company-profile-cover {
  padding: 0px 1rem;
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
  .email-location-wrapper {
    margin: 10px 0;
    div {
      color: #fff;
      font-size: 14px;
      display: flex;
      align-items: center;
      img {
        margin-right: 10px;
      }
    }
  }
  .tag-badge {
    background: $cv-primary;
    color: #fff;
    border-radius: 10px;
    padding: 5px 1rem;
    margin-right: 16px;
  }
  .company-name {
    font-size: 22px;
    color: #fff;
    font-weight: normal;
    margin-bottom: 10px;
  }
  height: 228px;
  .job-posted {
    color: #fff;
    a {
      color: #0ba88c;
      margin-right: 10px;
    }
  }
}
.company-profile-header {
  border-bottom: 1px solid #c4c4c4;
  margin-bottom: 10px;
  padding: 10px 0;
  .company-profile-title {
    h2 {
      font-size: 18px;
      margin: 0px;
    }
  }
  .company-profile-edit-btn {
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
// compnay profile

.company-profile-single-image-block {
  margin-bottom: 30px;
  img {
    width: 219px;
    height: 122px;
    border-radius: 10px;
  }
}
.about-content-wrapper {
  border-bottom: 1px solid #c4c4c4;
  padding-bottom: 3rem;
  p {
    font-size: 12px;
  }
}
.compnay-profile-logo {
  img {
    height: 100px;
    width: 100px;
    border-radius: 50%;
  }
}
.company-profile-body {
  padding: 0 10px;
  background: #fdfdfd;
  border: 1px solid #bdbdbd;
  box-sizing: border-box;
  box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.1);
  margin-bottom: 1rem;
}
.cv-copyright {
  p {
    font-size: 12px;
    a {
      color: $cv-primary;
      font-weight: 700;
    }
  }
}
</style>
