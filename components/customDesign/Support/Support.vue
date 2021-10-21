<template>
  <div class="support-team-container">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="support-content-wrapper">
            <div class="small-title">
              <p>we are open</p>
            </div>
            <div class="support-main-title">
              <h2>Support team open 24/7 for responsing your call</h2>
            </div>
            <div class="support-call-wrapper">
              <div class="call-us-button-wrapper">
                <div class="headphone-image-wrapper">
                  <img
                    alt="headphone"
                    class="img-fluid"
                    src="~/assets/image/career/1.png"
                  />
                </div>
                <div class="call-us-content-wrapper">
                  <p>Call us</p>
                  <p class="call-us-content-number">123456789</p>
                </div>
              </div>
              <div class="request-a-sarvice-button-wrapper">
                request a service
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map-image-wrapper">
            <img
              alt="map"
              src="~/assets/image/customerService.png"
              class="img-fluid"
            />
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
.support-content-wrapper {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.small-title {
  p {
    color: #0ba88c;
    text-transform: uppercase;
    margin-bottom: 1px;
    @include media('<=991px') {
      text-align: center;
      font-size: 14px;
    }
  }
}
.support-main-title {
  h2 {
    font-weight: bold;
    font-size: 30px;
    @include media('<=991px') {
      font-size: 22px;
      font-weight: 500;
      text-align: center;
    }
  }
}
.call-us-button-wrapper {
  display: flex;
  background: #f4f5f8;
  border: 1px solid #f7fffd;
  box-sizing: border-box;
  border-radius: 4px;
}
.support-call-wrapper {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  @include media('<=991px') {
    justify-content: center;
  }
}
.call-us-content-wrapper {
  @include media('<=991px') {
    justify-content: center;
  }
  p {
    margin: 0;
    font-size: 12px;
    font-weight: 500;
    color: rgba(29, 49, 70, 0.6);
    &:last-child {
      color: #0ba88c;
      font-weight: 600;
      font-size: 16px;
    }
  }
}
.headphone-image-wrapper {
  height: 40px;
  width: 40px;
  margin-right: 10px;
}

.call-us-button-wrapper {
  display: flex;
  align-items: center;
  padding: 5px 50px 5px 5px;
  margin-right: 20px;
}
.request-a-sarvice-button-wrapper {
  background: #0ba88c;
  border-radius: 4px;
  padding: 15px 40px;
  font-weight: bold;
  color: #fff;
  @include media('<=991px') {
    margin-top: 10px;
  }
}
</style>
