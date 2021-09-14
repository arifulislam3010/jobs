<template>
  <div class="hot-jobs-container">
    <div class="container">
      <div
        class="hot-jobs-header-wrapper mb-md-4 mb-sm-2 d-flex justify-content-between"
      >
        <div class="hot-jobs-title">
          <h2>Hot Jobs</h2>
        </div>
        <div class="hot-jobs-search-wrapper">
          <form>
            <div class="hot-jobs-form-group">
              <input type="text" name="search" placeholder="search jobs" />
              <div class="search-icon">
                <img
                  src="~/assets/image/jobs/searchIcon.png"
                  alt="serchIcon"
                  class="img-fluid"
                />
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- filter button -->
      <div class="filter-button-wrapper mb-5">
        <div class="filter-button-content">
          <div class="filter-button active">
            All
          </div>
          <div
            class="filter-button"
            v-for="cat in category.slice(0, 5)"
            :key="cat.it"
          >
            {{ cat.label }}
          </div>
        </div>
      </div>
      <!-- jobs section -->
      <div class="job-section-wrapper">
        <div class="row">
          <div class="col-md-3" v-for="job in jobsAll" :key="job.id">
            <nuxt-link to="/job-search">
              <div class="single-job-container">
                <div class="job-components-header-wrapper ">
                  <div class="job-components-company-logo">
                    <img src="~/assets/image/jobs/square.png" />
                  </div>
                  <div class="company-name">
                    <h5>{{ job.name }}</h5>
                  </div>
                </div>
                <div class="job-section-job-list">
                  <ul>
                    <li v-for="post in job.posts.slice(0, 3)" :key="post.id">
                      <!-- <span>Job post name</span> : -->
                      <span>{{ post.headline }}</span>
                    </li>
                    <!-- <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li> -->
                  </ul>
                </div>
              </div>
            </nuxt-link>
          </div>
          <!-- <div class="col-md-3">
            <div class="single-job-container">
              <div class="job-components-header-wrapper ">
                <div class="job-components-company-logo">
                  <img src="~/assets/image/jobs/square.png" />
                </div>
                <div class="company-name">
                  <h5>Square Ltd.</h5>
                </div>
              </div>
              <div class="job-section-job-list">
                <ul>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="single-job-container">
              <div class="job-components-header-wrapper ">
                <div class="job-components-company-logo">
                  <img src="~/assets/image/jobs/square.png" />
                </div>
                <div class="company-name">
                  <h5>Square Ltd.</h5>
                </div>
              </div>
              <div class="job-section-job-list">
                <ul>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="single-job-container">
              <div class="job-components-header-wrapper ">
                <div class="job-components-company-logo">
                  <img src="~/assets/image/jobs/square.png" />
                </div>
                <div class="company-name">
                  <h5>Square Ltd.</h5>
                </div>
              </div>
              <div class="job-section-job-list">
                <ul>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                  <li>
                    <span>Job post name</span> :
                    <span>Position Lorem ipsum dolor sit amet.</span>
                  </li>
                </ul>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['jobsAll', 'category'],
  data() {
    return {
      jobAll: this.jobsAll
      // category: this.category
    }
  }
}
</script>

<style lang="scss">
.hot-jobs-title {
  h2 {
    color: #1d3146;
    font-size: 38px;
    font-weight: 600;
  }
}
.hot-jobs-form-group {
  position: relative;
  input {
    border-radius: 38px;
    border: 1px solid #ebebeb;
    padding: 10px 50px;
    &:focus {
      outline: 0;
    }
    &::placeholder {
      color: rgba(29, 49, 70, 0.6);
      font-size: 14px;
    }
  }
  .search-icon {
    position: absolute;
    top: 11px;
    left: 20px;
    width: 16px;
    height: 16px;
  }
}
.filter-button-content {
  display: flex;
  flex-wrap: wrap;
  .filter-button {
    padding: 10px 20px;
    margin-right: 10px;
    border-radius: 8px;
    border: 1px solid #dedede;
    font-size: 14px;
    font-weight: 500;
    color: rgba(29, 49, 70, 0.7);
    box-shadow: 10px 24px 40px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: 0.3s;
    &:hover {
      background: #02ab8d;
      color: #fff;
    }
  }
  .active {
    background: #02ab8d;
    color: #fff;
  }
}
// jobs

.job-components-header-wrapper {
  display: flex;
  align-items: center;
  margin-bottom: 1rem;
  .job-components-company-logo {
    height: 30px;
    width: 30px;
    border: 1px solid #dbdbdb;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
    box-shadow: 10px 24px 40px rgba(0, 0, 0, 0.1);
    margin-right: 20px;
  }
  .company-name {
    h5 {
      font-size: 14px;
      color: #1d3146;
      font-weight: 500;
      margin: 0;
    }
  }
}
.job-section-job-list ul {
  margin: 0;
  padding: 0;
  li {
    list-style: none;
    width: 100%;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    font-weight: 500;
  }
}
.single-job-container {
  padding: 10px;
  width: 100%;
  background: #f8fbf8;
  border: 1px solid #bdbdbd;
  box-sizing: border-box;
  border-radius: 4px;
  height: 140px;

  &:hover {
    background: #ffffff;
    border: 2px solid #1d3146;
    box-sizing: border-box;
    box-shadow: 10px 40px 60px 20px rgba(0, 0, 0, 0.06),
      -10px 40px 60px 20px rgba(0, 0, 0, 0.06);
    border-radius: 4px;
  }
}
</style>
