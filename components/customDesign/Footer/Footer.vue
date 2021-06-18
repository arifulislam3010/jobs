<template>
  <footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          <div class="main-footer-content-wrapper">
            <div class="footer-menu-title">
              <h5>Contact</h5>
            </div>
            <div class="footer-main-menu-item">
              <ul>
                <li>01794383900</li>
                <li><nuxt-link to="/">info@mechanic.com</nuxt-link></li>
                <li>
                  House #63 (1st Floor)Road #04, Block-CBanani, Dhaka 1213
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="main-footer-content-wrapper">
            <div class="footer-menu-title">
              <h5>Contact</h5>
            </div>
            <div class="footer-main-menu-item">
              <ul>
                <li>01794383900</li>
                <li><nuxt-link to="/">info@mechanic.com</nuxt-link></li>
                <li>
                  House #63 (1st Floor)Road #04, Block-CBanani, Dhaka 1213
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="main-footer-content-wrapper">
            <div class="footer-menu-title">
              <h5>Contact</h5>
            </div>
            <div class="footer-main-menu-item">
              <ul>
                <li>01794383900</li>
                <li><nuxt-link to="/">info@mechanic.com</nuxt-link></li>
                <li>
                  House #63 (1st Floor)Road #04, Block-CBanani, Dhaka 1213
                </li>
                <li>
                  House #63 (1st Floor)Road #04, Block-CBanani, Dhaka 1213
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="main-footer-content-wrapper">
            <div class="footer-menu-title">
              <h5>Contact</h5>
            </div>
            <div class="footer-main-menu-item">
              <ul>
                <li>01794383900</li>
                <li><nuxt-link to="/">info@mechanic.com</nuxt-link></li>
                <li>
                  Tackle your to-do list wherever you are with our mobile app &
                  make your life easy
                </li>
                <li>
                  <div class="app-download-button-wrapper">
                    <div
                      class="google-play-button-wrapper app-download-button mr-3"
                    >
                      <nuxt-link to="">
                        <img
                          src="~/assets/image/storeIcon/googlePlay.png"
                          alt="app store"
                          class="img-fluid"
                        />
                      </nuxt-link>
                    </div>
                    <div class="ios-button-wrapper app-download-button">
                      <nuxt-link to="">
                        <img
                          src="~/assets/image/storeIcon/googlePlay.png"
                          alt="app store"
                          class="img-fluid"
                        />
                      </nuxt-link>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="main-footer-copyright-text">
          <p class="">
            Copyright © 2020 Mechanic Platform Limited | All Rights Reserved
          </p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {}
</script>

<style lang="scss">
.main-footer {
  background: #131616;
  padding: 100px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}
.footer-menu-title {
  h5 {
    color: #0ba88c;
    font-weight: bold;
    font-size: 16px;
  }
}
.footer-main-menu-item {
  ul {
    margin: 0;
    padding: 0;
  }
  li {
    list-style: none;
    margin: 15px 0;
    color: #fff;
    a {
      color: #fff;
      text-decoration: none;
    }
  }
}
.main-footer-copyright-text {
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: -6rem;
  p {
    color: #fff;
  }
}
.app-download-button-wrapper {
  display: flex;
  .google-play-button-wrapper {
    margin-right: 1rem;
  }
}
</style>
