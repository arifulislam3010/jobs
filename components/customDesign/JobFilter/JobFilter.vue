<template>
  <div class="job-filter-wrapper mb-5">
    <div class="job-filter-section-heading">
      <h5>Filters Criteria</h5>
    </div>
    <div class="job-filter-form">
      <div class="form-group">
        <input
          type="text"
          class="form-control"
          placeholder="Job Title or Keyward"
        />
      </div>
      <div class="form-group">
        <select name="" id="" class="form-control">
          <option selected>Select Location</option>
        </select>
      </div>
    </div>
    <div class="job-filter-list">
      <!-- job category item -->
      <div class="single-job-category-item">
        <div
          class="list-heading-wrapper d-flex justify-content-between align-items-center mt-3 mb-2"
          v-b-toggle.collapse-10
        >
          <div class="list-heading">
            <h4>Type of employement</h4>
          </div>
          <div class="list-collaps-icon">
            <i class="fas fa-angle-up"></i>
          </div>
        </div>
        <b-collapse visible id="collapse-10">
          <div class="collaps-item">
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
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
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper ">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper ">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper ">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
          </div>
        </b-collapse>
      </div>
      <div class="job-filter-number-input mt-3 mb-3">
        <div class="list-heading">
          <h4>Type of employement</h4>
        </div>
        <div class="job-number_sort_form">
          <input type="number" placeholder="MIN" />
          <input type="number" placeholder="MAX" />
          <button type="submit" class="sort_submit_btn">Apply</button>
        </div>
      </div>
      <!-- copy from here -->
      <div class="single-job-category-item">
        <div
          class="list-heading-wrapper d-flex justify-content-between align-items-center mt-3 mb-2"
          v-b-toggle.collapse-11
        >
          <div class="list-heading">
            <h4>Type of employement</h4>
          </div>
          <div class="list-collaps-icon">
            <i class="fas fa-angle-up"></i>
          </div>
        </div>

        <b-collapse visible id="collapse-11">
          <div class="collaps-item">
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
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
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper ">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper ">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper ">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
            <div
              class="job-filter-list-item d-flex justify-content-between align-items-center"
            >
              <div class="checkbox-wrapper">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" />
                  <label class="form-check-label">Full Time Job</label>
                </div>
              </div>
              <div class="job-post-count">
                <p>128</p>
              </div>
            </div>
          </div>
        </b-collapse>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {}
}
// collaps functionality
</script>

<style lang="scss">
@import '../../../assets/scss/responsive';

// accordion functionality
.job-filter-section-heading {
  h5 {
    color: #1d3146;
    font-size: 12px;
    font-weight: 600;
  }
}

.job-filter-wrapper {
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
    width: 50%;
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
.collaps-item {
  overflow: hidden;
  max-height: max-content;
  transition: max-height 0.5s;
}
.list-heading-wrapper.d-flex.justify-content-between.align-items-center.mt-3.mb-2.collapsed {
  i.fas.fa-angle-up {
    &::before {
      content: '\f107';
    }
  }
}
</style>
