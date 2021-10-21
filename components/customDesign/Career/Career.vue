<template>
  <div class="grow-career-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
          <div class="grow-career-image-wrapper">
            <img class="img-fluid" src="~/assets/image/career/man.png" />
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12 col-sm-12 career-content">
          <div class="grow-career-content-container">
            <div class="grow-career-title">
              <h2>Grow your career</h2>
            </div>
            <div class="grow-career-content">
              <p>
                Pathao, Chaldal, and over 100,000 startups of all sizes have
                used Mechanic to hire people like you. Already know where you
                want to be? You can apply directly—and privately—to early stage
                startups and industry leaders alike
              </p>
            </div>
            <div class="career-button-wrapper mt-md-3 mt-sm-2">
              <nuxt-link to="/job-search">Find a job</nuxt-link>
              <nuxt-link to="/job-search">Post a job</nuxt-link>
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
.grow-career-wrapper {
  .row {
    .career-content {
      padding: 20px inherit;
      @include media('<=991px') {
        text-align: center;
        margin-top: 20px;
      }
    }
  }
  background: #131616;
  .grow-career-title {
    h2 {
      font-weight: 600;
      color: #fff;
      font-size: 40px;
      @include media('<=991px') {
        font-size: 22px;
      }
    }
  }
  .grow-career-content {
    p {
      color: rgba(255, 255, 255, 0.8);
      @include media('<=991px') {
        font-size: 12px;
      }
    }
  }
  .career-button-wrapper {
    @include media('<=991px') {
      padding-bottom: 20px;
    }
    a {
      &:first-child {
        margin-right: 10px;
        color: #fff;
        background: #02ab8d;
        box-shadow: 10px 24px 40px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px 40px;
        font-size: 18px;
        @include media('<=991px') {
          padding: 10px 20px;
          font-size: 14px;
        }
      }
      &:last-child {
        color: #02ab8d;
        text-decoration: underline;
      }
    }
  }
}
.grow-career-content-container {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.grow-career-image-wrapper {
  @include media('<=991px') {
    display: flex;
    justify-content: center;
  }
}
</style>
