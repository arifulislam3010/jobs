<template>
  <div class="job-filter-wrapp">
    <div class="job-filter-section-heading">
      <h5>Filters Criteria</h5>
    </div>
    <div class="job-filter-form">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Job Title or Keyward"
          v-model="title"
          @keyup="titleEvent()"
        />
      </div>
      <div class="form-group">
        <select name="" id="" class="form-control">
          <option selected>Select Location</option>
        </select>
      </div>
    </div>
    <div class="job-filter-list">
      <div
        class="list-heading-wrapper d-flex justify-content-between align-items-center mt-3 mb-2"
      >
        <div class="list-heading">
          <h4>Type of employement</h4>
        </div>
        <div class="list-collaps-icon">
          <i class="fas fa-angle-up"></i>
        </div>
      </div>
      <!-- <div class="job-filter-list-item d-flex justify-content-between align-items-center">
        <div class="checkbox-wrapper ">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
            />
            <label class="form-check-label" for="exampleCheck1"
              >Full Time Job</label
            >
          </div>
        </div>
        <div class="job-post-count">
          <p>128</p>
        </div>
      </div> -->
      <treeselect
        name="job"
        placeholder="জনবল পাঠানো চাকুরী"
        v-model="this.$parent.job"
        :multiple="true"
        :options="this.$parent.jobs"
      />

      <!-- //need  to cut  -->
      <div
        class="job-filter-list-item d-flex justify-content-between align-items-center"
        v-for="job in allJob"
        :key="job.id"
      >
        <div class="checkbox-wrapper ">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
              name="title"
              @click="jobTypeAction(job.id)"
            />
            <label class="form-check-label" for="exampleCheck1">{{
              job.category_name
            }}</label>
          </div>
        </div>
        <div class="job-post-count">
          <p>128</p>
        </div>
      </div>

      <!-- // upto this section  -->

      <div class="job-filter-number-input mt-3 mb-3">
        <div class="list-heading">
          <h4>Salary Range</h4>
        </div>
        <div class="job-number_sort_form">
          <input type="number" placeholder="MIN" />
          <input type="number" placeholder="MAX" />
          <button type="submit" class="sort_submit_btn">Apply</button>
        </div>
      </div>
      <div
        class="list-heading-wrapper d-flex justify-content-between align-items-center mt-3 mb-2"
      >
        <div class="list-heading">
          <h4>Seniority Level</h4>
        </div>
        <div class="list-collaps-icon">
          <i class="fas fa-angle-up"></i>
        </div>
      </div>

      <!-- //senior level  -->
      <div
        class="job-filter-list-item d-flex justify-content-between align-items-center"
        v-for="seniorj in seniorLevel"
        :key="seniorj.id"
      >
        <div class="checkbox-wrapper ">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
              @click="seniorLevelAction(seniorj.id)"
            />
            <label class="form-check-label" for="exampleCheck1">{{
              seniorj.level
            }}</label>
          </div>
        </div>
        <div class="job-post-count">
          <p>128</p>
        </div>
      </div>

      <!-- // time line  -->
      <div
        class="list-heading-wrapper d-flex justify-content-between align-items-center mt-3 mb-2"
      >
        <div class="list-heading">
          <h4>Job Poster or Deadline</h4>
        </div>
        <div class="list-collaps-icon">
          <i class="fas fa-angle-up"></i>
        </div>
      </div>

      <div
        class="job-filter-list-item d-flex justify-content-between align-items-center"
        v-for="ago in time"
        :key="ago.id"
      >
        <div class="checkbox-wrapper ">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
            />
            <label class="form-check-label" for="exampleCheck1"
              >{{ ago.name }} ago</label
            >
          </div>
        </div>
        <div class="job-post-count">
          <p>{{ ago.job }}</p>
        </div>
      </div>

      <!-- // gender specific  -->
      <div
        class="list-heading-wrapper d-flex justify-content-between align-items-center mt-3 mb-2"
      >
        <div class="list-heading">
          <h4>Gender Specific</h4>
        </div>
        <div class="list-collaps-icon">
          <i class="fas fa-angle-up"></i>
        </div>
      </div>

      <div
        class="job-filter-list-item d-flex justify-content-between align-items-center"
        v-for="sex in gender"
        :key="sex.id"
      >
        <div class="checkbox-wrapper ">
          <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="exampleCheck1"
              @click="genderAction(sex.id)"
            />
            <label class="form-check-label" for="exampleCheck1"
              >{{ sex.name }} ago</label
            >
          </div>
        </div>
        <div class="job-post-count">
          <p>{{ sex.job }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['jobType', 'senior'],
  data() {
    return {
      allJob: this.jobType,
      seniorLevel: this.senior,
      title: '',
      time: [
        {
          id: 200,
          name: 'Today',
          job: '100'
        },
        {
          id: 201,
          name: '3 days ',
          job: '100'
        },
        {
          id: 202,
          name: '1 week',
          job: '100'
        },
        {
          id: 203,
          name: '1 month',
          job: '100'
        }
      ],
      gender: [
        {
          id: 300,
          name: 'Any',
          job: '100'
        },
        {
          id: 301,
          name: 'Men',
          job: '100'
        },
        {
          id: 302,
          name: 'Women',
          job: '100'
        },
        {
          id: 303,
          name: 'Disable Person',
          job: '100'
        }
      ]
    }
  },
  methods: {
    titleEvent(e) {
      this.$emit('jobTitle', this.title)
    },
    jobTypeAction(e) {
      this.$emit('jobTypeActionEmit', e)
    },
    seniorLevelAction(e) {
      this.$$emit('seniorLevelEmit', e)
    },
    genderAction(e) {
      this.$$emit('genderEmit', e)
    }
  }
}
</script>

<style lang="scss">
.job-filter-section-heading {
  h5 {
    color: #1d3146;
    font-size: 12px;
    font-weight: 600;
  }
}
.job-filter-wrapp {
  border: 1px solid #bdbdbd;
  box-sizing: border-box;
  border-radius: 4px;
  padding: 1rem;
}
.list-heading {
  h4 {
    font-style: normal;
    font-weight: 600;
    font-size: 16px;
    color: #1d3146;
    margin: 0px;
  }
}

.job-post-count {
  p {
    margin: 0px;
    font-size: 10px;
    color: rgba(29, 49, 70, 0.8);
    background: #f9f9f9;
    border: 1px solid #bdbdbd;
    border-radius: 4px;
    padding: 5px 10px;
    font-weight: 600;
    transition: 0.3s;
    &:hover {
      background: #e8fefa;
      color: #0ba88c;
    }
  }
}

.checkbox-wrapper {
  margin: 0.5rem 0;
  label {
    font-weight: 600;
    font-size: 12px;
    line-height: 18px;
    color: rgba(29, 49, 70, 0.8);
  }
}

.job-number_sort_form {
  display: flex;
  margin-top: 1rem;
  align-items: center;
}

.job-number_sort_form {
  input {
    background: #ffffff;
    border: 1px solid #bdbdbd;
    box-sizing: border-box;
    border-radius: 4px;
    width: 110px;
    height: 32px;
    margin-right: 10px;
    padding: 10px;
    &:focus {
      outline: 0;
    }
  }
}

.sort_submit_btn {
  background: #0ba88c;
  border-radius: 4px;
  border: none;
  width: 68px;
  height: 32px;
  color: #fff;
  font-size: 12px;
}
</style>
