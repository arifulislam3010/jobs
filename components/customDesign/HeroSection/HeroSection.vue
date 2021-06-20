<template>
  <div class="herosection-wrapper">
    <div class="container">
      <div class="hero-section-content-wrapper">
        <div class="hero-section-title-wrapper">
          <h2>One Search, Millions of Jobs</h2>
        </div>
        <div class="hero-search-jobs-wrapper">
          <form>
            <div class="job-title input-group position-relative">
              <input type="text" placeholder="Job Title,Skills or Company" />
              <div class="bag-image-wrapper">
                <img
                  alt="form icon"
                  src="~/assets/image/hero/bag.png"
                  class="img-fluid"
                />
              </div>
            </div>
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
            <div class="job-title-submit-button">
              <button type="submit">Search Jobs</button>
            </div>
          </form>
        </div>
        <div class="create-cv-section">
          <p>
            <nuxt-link to="#">upload </nuxt-link> <span> or </span
            ><nuxt-link to="#"> create resume </nuxt-link> easily apply to jobs.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style lang="scss">
.herosection-wrapper {
  min-height: 420px;
  display: flex;
  background-image: url('~assets/image/hero/bg.png');
  align-items: center;
  .hero-search-jobs-wrapper {
    form {
      display: flex;
    }
  }
  .input-group {
    width: auto !important;
    input {
      border: 1px solid #d8d8d8;
      box-sizing: border-box;
      border-radius: 8px;
      padding: 0px 80px 0px 40px;
      color: rgba(55, 58, 72, 0.6);
      margin-right: 10px;
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

.location.input-group {
  input {
    padding: 0px 30px 0px 30px;
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
    padding: 10px 30px;
    color: #fff;
  }
}
.hero-section-title-wrapper {
  h2 {
    font-weight: 600;
    font-size: 48px;
  }
}

.create-cv-section {
  margin-top: 1rem;
}

.create-cv-section {
  p {
    font-weight: 600;
    a {
      color: #02ab8d;
    }
  }
}
.hero-search-jobs-wrapper {
  background: #ffffff;
  border: 1px solid #d8d8d8;
  box-sizing: border-box;
  border-radius: 8px;
  width: 54vw;
  padding: 15px;
}
</style>
