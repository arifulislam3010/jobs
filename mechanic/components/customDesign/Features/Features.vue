<template>
  <div class="features-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div
            class="features-content-wrapper h-100 d-flex flex-column justify-content-center"
          >
            <div class="features-heading mb-1">
              <h2>Features</h2>
            </div>
            <div class="single-features-content-wrapper">
              <div class="features-content-heading">
                <p>
                  <span> <i class="fas fa-chevron-right"></i> </span> Get
                  Regular Job Updates
                </p>
              </div>
              <div class="features-content">
                <p>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Nihil ducimus debitis non qui at sequi, magnam odit voluptates
                  vero placeat fuga dicta sint consequuntur, culpa temporibus
                  corrupti, doloremque libero explicabo?
                </p>
              </div>
            </div>
            <div class="single-features-content-wrapper">
              <div class="features-content-heading">
                <p>
                  <span> <i class="fas fa-chevron-right"></i> </span> Get
                  Regular Job Updates
                </p>
              </div>
              <div class="features-content">
                <p>
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Nihil ducimus debitis non qui at sequi, magnam odit voluptates
                  vero placeat fuga dicta sint consequuntur, culpa temporibus
                  corrupti, doloremque libero explicabo?
                </p>
              </div>
            </div>
            <div class="features-app-download-section mt-3 mt-sm-3">
              <div class="features-app-content-heading">
                <p>
                  download our app
                  <span> <i class="fas fa-chevron-right"></i> </span>
                </p>
              </div>
              <div class="app-download-button-wrapper features-section">
                <nuxt-link to="#">
                  <img
                    alt="app"
                    src="~/assets/image/storeIcon/googlePlay.png"
                    class="img-fluid"
                  />
                </nuxt-link>
                <nuxt-link to="">
                  <img
                    alt="app"
                    src="~/assets/image/storeIcon/googlePlay.png"
                    class="img-fluid"
                  />
                </nuxt-link>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="app-screen-wrapper">
            <img
              alt="app screen"
              src="~/assets/image/features/appScreen.png"
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
.features-heading {
  h2 {
    font-weight: 600;
    font-size: 48px;
    color: #1d3146;
  }
}
.features-content-heading {
  p {
    font-weight: 600;
    font-size: 16px;
    color: #1d3146;
  }
}
.features-content {
  p {
    color: rgba(29, 49, 70, 0.8);
    font-weight: 500;
    font-size: 14px;
    line-height: 1.5;
  }
}
.features-app-content-heading {
  p {
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    line-height: 24px;
    color: #0ba88c;
    span {
      color: #0ba88c;
      i {
        color: #0ba88c;
      }
    }
  }
}

.app-download-button-wrapper.features-section {
  a {
    margin-right: 20px;
  }
}
</style>
