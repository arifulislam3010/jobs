<template>
  <div class="job-category-container">
    <div class="container">
      <div class="job-category-heading">
        <h2>Job Categories</h2>
        <!-- <p>test</p> -->
      </div>
      <div class="job-category-button-wrapper">
        <div class="job-category-single-button-wrapper">
          <div class="job-category-button active">Full-time</div>
          <div class="job-category-button">Full-time</div>
          <div class="job-category-button">Full-time</div>
          <div class="job-category-button">Full-time</div>
          <div class="job-category-button">Full-time</div>
          <div class="job-category-button">Full-time</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4" v-for="cat in category" :key="cat.id">
          <div class="job-list-wrapper">
            <ul>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="/job-search">{{ cat.label }}</nuxt-link>
              </li>
              <!-- <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li> -->
            </ul>
          </div>
        </div>
        <!-- <div class="col-md-4">
          <div class="job-list-wrapper">
            <ul>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="job-list-wrapper">
            <ul>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
              <li>
                <i class="fas fa-chevron-right"></i>
                <nuxt-link to="#">Accounting/Finance (288)</nuxt-link>
              </li>
            </ul>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['category'],
  data() {
    return {
      categoryef: this.category
    }
  }
}
</script>

<style lang="scss">
.job-category-container {
  background: #131616;
  padding: 50px 0;
  .job-category-heading {
    h2 {
      font-weight: 600;
      font-size: 48px;
      color: #fff;
    }
  }
  .job-category-single-button-wrapper {
    display: flex;
    background: #0e1010;
    border-radius: 8px;
    justify-content: space-between;
    width: 70%;
  }
  .job-category-button {
    color: rgba(255, 255, 255, 0.6);
    font-weight: 500;
    padding: 10px 25px;
    transition: 0.3s;
    cursor: pointer;
    &:hover {
      background: #02ab8d;
      box-shadow: 10px 24px 40px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      color: #fff;
    }
  }
  .active {
    background: #02ab8d;
    box-shadow: 10px 24px 40px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    color: #fff;
  }
  .job-list-wrapper {
    margin-top: 1.5rem;
    display: flex;
    justify-content: space-between;
    ul {
      margin: 0;
      padding: 0;
      li {
        list-style: none;
        margin: 10px 0;
        i {
          color: #fff;
          margin-right: 10px;
        }
        a {
          color: #fff;
        }
      }
    }
  }
}
</style>
