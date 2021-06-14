<template>
<footer class="footer">
    <div class="container">
    <div class="row row-grid align-items-center mb-5">
        <div class="col-lg-6">
        <h3 class="text-primary font-weight-light mb-2">Thank you for supporting us!</h3>
        <h4 class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</h4>
        </div>
        <div class="col-lg-6 text-lg-center btn-wrapper">
        <button target="_blank" href="https://twitter.com" class="btn btn-icon-only btn-twitter rounded-circle" data-toggle="tooltip" data-original-title="Follow us">
            <span class="btn-inner--icon"><i class="fa fa-twitter"></i></span>
        </button>
        <button target="_blank" href="https://www.facebook.com" class="btn-icon-only rounded-circle btn btn-facebook" data-toggle="tooltip" data-original-title="Like us">
            <span class="btn-inner--icon"><i class="fab fa-facebook"></i></span>
        </button>
        </div>
    </div>
    <hr>
    <div class="row align-items-center justify-content-md-between">
        <div class="col-md-6">
            <div class="copyright">
                &copy; 2019 <a href="#" target="_blank">Immigration</a>.
            </div>
        </div>
        <!-- <div class="col-md-6">
        <ul class="nav nav-footer justify-content-end">
            <li class="nav-item">
                <a href="#" class="nav-link footer_social_icon" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link footer_social_icon" target="_blank">Orange</a>
            </li>
        </ul>
        </div> -->
    </div>
    </div>
</footer>
</template>
<script>
export default {
  name: 'dashboard-footer',
  data() {
    return {
      year: new Date().getFullYear()
    }
  }
};
</script>
<style>
.footer_social_icon{
    background: #115cf3;
    border-radius: 26px;
}
.footer .footer-link, .footer .nav .nav-item .nav-link { color: #fff !important; padding-right: 10px; margin-right: 10px; }
</style>