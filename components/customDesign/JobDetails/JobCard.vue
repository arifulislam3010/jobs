<template>
  <div class="job-card-wrapper mb-5">
    <div class="job-card-content-wrapper p-3">
      <div class="job-card-header">
        <div class="job-title">
          <div class="logo-wrapper">
            <img
              src="~/assets/image/appleLogo.png"
              alt="job logo"
              class="img-fluid"
            />
          </div>
          <div class="job-subtitle">
            <div class="job-position">
              <h4>Product Designer</h4>
              <p>Apple, have a bite</p>
            </div>
          </div>
          <div class="job-card-badge">New</div>
        </div>
        <div class="save-badge">
          <button><i class="far fa-bookmark"></i>Save</button>
        </div>
      </div>
      <div class="job-card-body mt-2 pr-3 pl-5">
        <div class="row">
          <div class="col">
            <div class="job-details-wrapper">
              <div class="job-details-title">
                <p>Experience</p>
              </div>
              <div class="job-details-sub-title">
                <h5>3 to 5 Years</h5>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="job-details-wrapper">
              <div class="job-details-title">
                <p>Experience</p>
              </div>
              <div class="job-details-sub-title">
                <h5>3 to 5 Years</h5>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="job-details-wrapper">
              <div class="job-details-title">
                <p>Experience</p>
              </div>
              <div class="job-details-sub-title">
                <h5>3 to 5 Years</h5>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="job-details-wrapper">
              <div class="job-details-title">
                <p>Experience</p>
              </div>
              <div class="job-details-sub-title">
                <h5>3 to 5 Years</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="job-card-footer ">
      <div
        class="job-card-footer-content  pt-3 pb-3 pl-5 pr-3 d-flex justify-content-between align-items-center "
      >
        <div class="job-collapse-button">
          <a
            data-toggle="collapse"
            href="#collapseExample"
            role="button"
            aria-expanded="false"
            aria-controls="collapseExample"
          >
            Job Details <i class="fas fa-angle-down"></i>
          </a>
        </div>
        <div class="job-post-status">
          <p>Posted <span> 8hrs ago</span></p>
        </div>
      </div>
    </div>
    <div class="job-card-main-content-wrapper" id="collapseExample">
      <div class="job-card-main-content  d-flex justify-content-between">
        <div class="job-card-main-content-heading">
          <div class="job-card-heading">
            <p>We are looking for...</p>
            <h4>Product Designer</h4>
          </div>
        </div>
        <div class="card-expand-close-button-wrapper">
          <button class="active"><i class="fas fa-times"></i> close</button>
          <button>Apply now</button>
        </div>
      </div>
      <div class="job-vacancy-wrapper">
        <div class="single-job-vacancy-wrapper">
          <i class="fas fa-briefcase"></i> Full time
        </div>
        <div class="single-job-vacancy-wrapper">
          <i class="far fa-clock"></i> Dhaka Bangladesh
        </div>
        <div class="single-job-vacancy-wrapper">
          <i class="fas fa-users"></i> Hiring 04 person
        </div>
      </div>
      <div class="context-wrapper">
        <div class="context-content">
          <h4>Job Context:</h4>
          <p>
            Conduct user experience through surveys and focus groups in
            collaboration with internal members and existing participants and
            focus groups in collaboration with internal members and existing
            participants, members and existing participants and focus groups in
            collaboration.
          </p>
        </div>
      </div>
      <div class="job-description">
        <h4>Job description</h4>
        <div class="job-description-list">
          <ul>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members and existing participants and
              focus groups in collaboration with internal members and existing
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
          </ul>
        </div>
      </div>
      <div class="job-description">
        <h4>Job description</h4>
        <div class="job-description-list">
          <ul>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members and existing participants and
              focus groups in collaboration with internal members and existing
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
          </ul>
        </div>
      </div>
      <div class="job-condition-wrapper">
        <div class="single-job-condition-wrapper">
          <h4>Salary Range <span class="ml-5"> : Negotiable</span></h4>
        </div>
        <div class="single-job-condition-wrapper">
          <h4>Salary Range <span class="ml-5"> : Negotiable</span></h4>
        </div>
      </div>
      <div class="job-description">
        <h4>Job description</h4>
        <div class="job-description-list">
          <ul>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members and existing participants and
              focus groups in collaboration with internal members and existing
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
            <li>
              Conduct user experience through surveys and focus groups in
              collaboration with internal members.
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {}
</script>

<style lang="scss">
.job-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.job-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.job-title {
  display: flex;
}

.logo-wrapper {
  height: 40px;
  width: 40px;
  background: #ffffff;
  border: 1px solid #bdbdbd;
  box-sizing: border-box;
  border-radius: 7px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 5px;
  margin-right: 10px;
}
.job-position {
  h4 {
    font-size: 16px;
    color: #0fa489;
    font-weight: 600;
    margin: 0;
  }
  p {
    font-weight: 500;
    font-size: 12px;
    line-height: 18px;
    color: rgba(29, 49, 70, 0.8);
  }
}
.job-card-badge {
  background: #ee5d77;
  color: #fff;
  margin-left: 50px;
  width: 44px;
  height: 19px;
  font-size: 12px;
  text-align: center;
  border-radius: 2px;
}

.save-badge {
  button {
    background: #f9f9f9;
    border: 1px solid #bdbdbd;
    box-sizing: border-box;
    border-radius: 4px;
    width: 80px;
    height: 32px;
    i {
      margin-right: 10px;
    }
  }
}
.job-details-title {
  p {
    color: rgba(29, 49, 70, 0.6);
    font-size: 12px;
    margin: 0;
  }
}

.job-details-sub-title {
  h5 {
    color: #1d3146;
    font-size: 14px;
    font-weight: 500;
  }
}
.job-card-wrapper {
  background: #fdfdfd;
  border: 1px solid #bdbdbd;
  box-shadow: 0px 6px 6px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
}
.job-collapse-button {
  a {
    color: #1d3146;
    font-weight: 500;
    font-size: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    i {
      margin-left: 10px;
    }
  }
}
.job-post-status {
  p {
    color: rgba(29, 49, 70, 0.6);
    font-size: 12px;
    margin: 0px;
  }
}
.job-card-footer {
  border-top: 1px solid #bdbdbd;
}
// job card content
.job-card-main-content-heading {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.job-card-heading {
  p {
    color: rgba(29, 49, 70, 0.4);
    font-size: 12px;
    margin: 0px;
    h4 {
      font-weight: 600;
      font-size: 16px;
      line-height: 18px;
      color: #1d3146;
    }
  }
}
.card-expand-close-button-wrapper {
  button {
    background: #f9f9f9;
    border: 1px solid #bdbdbd;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 5px 15px;
    margin: 10px;
    color: rgba(29, 49, 70, 0.8);

    &:nth-child(odd) {
      i {
        margin-right: 10px;
      }
    }
    &:hover {
      background: #0ba88c;
      color: #fff;
      i {
        color: #fff;
      }
    }
  }
}
.job-card-heading {
  h4 {
    font-weight: 600;
    font-size: 16px;
    color: #1d3146;
  }
}
.context-content {
  h4 {
    color: #1d3146;
    font-size: 16px;
    font-weight: 600;
  }
}

.context-content {
  p {
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 21px;
    color: rgba(29, 49, 70, 0.7);
  }
}
.job-description {
  h4 {
    color: #1d3146;
    font-size: 16px;
    font-weight: 600;
  }
}
.job-description-list {
  ul {
    margin: 0;
    padding-left: 1rem;
    li {
      font-weight: 500;
      font-size: 14px;
      line-height: 21px;
      color: rgba(29, 49, 70, 0.7);
      margin: 15px 0;
    }
  }
}
// job vacancy
.single-job-vacancy-wrapper {
  color: rgba(29, 49, 70, 0.8);
  font-size: 12px;
  font-weight: 600;
  margin-right: 20px;
  i {
    color: rgba(11, 168, 140, 0.6);
    font-size: 16px;
    margin-right: 15px;
    font-weight: bold;
  }
}
.job-vacancy-wrapper {
  display: flex;
  align-items: center;
  margin: 2rem 10px 2rem 0px;
}
.job-card-main-content-wrapper {
  padding: 0px 2rem;
}
.job-condition-wrapper {
  padding: 1.5rem 0;
  .single-job-condition-wrapper {
    h4 {
      font-weight: 600;
      font-size: 14px;
      color: #1d3146;
      span {
        font-weight: normal;
      }
    }
  }
}
</style>
