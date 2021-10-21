<template>
  <div class="herosection-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="hero-section-content-wrapper">
            <div class="hero-section-title-wrapper">
              <h2>One Search, Millions of Jobs</h2>
            </div>
            <div class="hero-search-jobs-wrapper">
              <form>
                <div class="row">
                  <div class="col-lg-6 form-element">
                    <div class="job-title input-group position-relative">
                      <input
                        type="text"
                        placeholder="Job Title,Skills or Company"
                      />
                      <div class="bag-image-wrapper">
                        <img
                          alt="form icon"
                          src="~/assets/image/hero/bag.png"
                          class="img-fluid"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 pl-0 form-element">
                    <div class="location input-group position-relative">
                      <input type="text" placeholder="Location or City" />
                      <div class="location-image-wrapper position-absolute">
                        <img
                          alt="form icon"
                          src="~/assets/image/hero/location.png"
                          class="img-fluid"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-2 pl-0 ml-0 form-element">
                    <div class="job-title-submit-button">
                      <button type="submit">Search Jobs</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="create-cv-section">
              <p>
                <nuxt-link to="#">upload </nuxt-link> <span> or </span
                ><nuxt-link to="#"> create resume </nuxt-link> easily apply to
                jobs.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style lang="scss">
@import '../../../assets/scss/responsive';
.herosection-wrapper {
  min-height: 420px;
  display: flex;
  background-image: url('~assets/image/hero/bg.png');
  align-items: center;
  .input-group {
    width: auto !important;
    input {
      border: 1px solid #d8d8d8;
      box-sizing: border-box;
      border-radius: 8px;
      width: 100%;
      color: rgba(55, 58, 72, 0.6);
      margin-right: 10px;
      padding: 10px 5px 10px 40px;
      font-size: 12px;
      @include media('<=991px') {
        padding: 10px 5px 10px 70px;
      }
      &:focus {
        outline: 0;
      }
    }

    .bag-image-wrapper {
      position: absolute;
      top: 23%;
      left: 5%;
    }
  }
}
form {
  .row {
    .form-element {
      @include media('<=991px') {
        padding-left: 15px !important;
        padding-right: 15px !important;
        margin-bottom: 10px;
      }
    }
  }
}
.location.input-group {
  input {
    width: 100%;
    padding: 10px 5px 10px 30px;
    @include media('<=991px') {
      padding: 10px 5px 10px 70px;
    }
  }
  .location-image-wrapper {
    @extend .bag-image-wrapper;
  }
}
.job-title-submit-button {
  button {
    background: #0ba88c;
    border-radius: 8px;
    border: none;
    font-size: 12px;
    color: #fff;
    width: 100%;
    padding: 10px 0px;
  }
}
.hero-section-title-wrapper {
  h2 {
    font-weight: 600;
    font-size: 35px;
    @include media('<=991px') {
      font-size: 20px;
    }
  }
}

.create-cv-section {
  margin-top: 1rem;
}

.create-cv-section {
  p {
    font-weight: 600;
    font-size: 14px;
    a {
      color: #02ab8d;
    }
  }
}
.hero-search-jobs-wrapper {
  background: #fff;
  border: 1px solid #d8d8d8;
  box-sizing: border-box;
  border-radius: 8px;
  width: 100%;
  padding: 15px;
}
</style>
