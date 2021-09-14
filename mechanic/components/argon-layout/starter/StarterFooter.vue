<template>
    <footer class="footer footer-big">
        <div class="container footer-container">
            <div class="content">
                <div class="row">
                    <div class="col-md-4">
                        <div class="column">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="../../../assets/icon/logo_footer_icon.png" class="logo" alt="">
                                </div>
                                <div class="col-md-8">
                                    <span style="font-size:16px;" class="slider-search">অনুসন্ধান </span>
                                    <form action="/action_page.php">
                                        <div class="input-group">
                                          <input type="text" style="font-size:14px;"  class="search-input" placeholder="প্রশিক্ষণ কেন্দ্র, নিয়োগকারী সংস্থা" name="search">
                                          <div class="input-group-append">
                                            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                                          </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="column">
                            <ul>
                                <li><a href="javascript:;">জরুরি তথ্য ও সেবা</a></li>
                                <li><a href="tel:333">৩৩৩</a>, <a href="tel:999">৯৯৯</a></li>
                                <li><a href="javascript:;">যোগাযোগ</a></li>
                                <li><a href="http://www.bmet.gov.bd/BMET/index">বিএমইটি</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="column">
                            <ul>
                                <li><a href="https://bangladesh.gov.bd/index.php">জাতীয় তথ্য বাতায়ন</a></li>
                                <li><a href="http://eksheba.gov.bd/">একসেবা</a></li>
                                <li><a href="http://www.muktopaath.gov.bd/">মুক্তপাঠ</a></li>
                                <li><a href="https://probashi.gov.bd/">প্রবাসী কল্যাণ মন্ত্রণালয়</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="column">
                            <ul>
                                <li><a href="http://www.old.bmet.gov.bd/BMET/onlinaVisaCheckAction">অনলাইন ভিসা যাচাই</a></li>
                                <li><a href="http://pkb.gov.bd/">প্রবাসী কল্যাণ ব্যাংক</a></li>
                                <li><a href="http://www.boesl.gov.bd/">বোয়েসেল</a></li>
                                <li><a href="http://www.wewb.gov.bd/">ওয়েজ আর্নার্স কল্যাণ বোর্ড</a></li>
                                
                                
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-6">
                        <div class="column">
                            <ul>
                                <li><a href="javascript:;">সামাজিক যোগাযোগ</a></li>
                            </ul>
                            <div class="btn-wrapper profile text-left mt-3">
                                <a target="_blank" :href="facebook" class="btn btn-sm footer_social_icon" data-toggle="tooltip" data-original-title="Like us">
                                    <i class="fab fa-facebook-square"></i>
                                </a>
                                <a target="_blank" :href="youtube" class="btn btn-sm footer_social_icon" data-toggle="tooltip" data-original-title="Follow us" style="background-color: red;">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right mt-4">
                            <p style="font-size: 15px">Design & Developed By: <a href="http://www.orangebd.com" target="_blank" style="color: #ED7C31">orange<span style="color:#000">bd.com</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
import SearchButton from "~/components/custom/share/SearchButton.vue";
export default {
    components: {
      SearchButton,
    },
    name: 'starter-footer',
    data() {
        return {
            year: new Date().getFullYear(),
            youtube:'https://www.facebook.com/',
            facebook:'https://www.facebook.com/',
        }
    },
    mounted(){
        // this.getHotLine();
    },
    methods:{
        async getHotLine(){
            await this.$axios.get('/api/social-link').then(response =>{
                this.youtube = response.data.youtube
                this.facebook = response.data.facebook
            })
        }
    }
};
</script>
<style>
@media (min-width: 1200px){
    .footer-container {
      max-width: 1220px;
    }
}
.footer .column ul { margin-top: 10px; }
.footer .column ul>li>a{ font-size: 14px; }
.footer .column ul:not(.social-buttons) li { color: #8898aa; padding: 1px 0; }
.footer_social_icon { background: #115cf3; color: #fff; border-radius: 50%; }
.footer_social_icon:hover { color: #fff; }
.footer .column .logo { width: 100%; height: auto; max-width: 100px; }
.slider-search { font-size: 12px; }
.search-input { width: 200px; padding: 6px; margin-top: 8px; font-size: 17px; border: none; border-radius: 10px 0px 0px 10px; padding-left: 10px; font-size: 13px; margin-left: -10px; border: 1px solid #cccccc; }
.search-btn { float: right; padding: 6px 10px; padding-left: 0px; margin-top: 8px; margin-right: 16px; background: #ddd; font-size: 17px; border: none; cursor: pointer; border-width: 0px; background-color: #fff; border-radius: 0px 10px 10px 0px; border: 1px solid #cccccc; border-left-width: 0; }
</style>
