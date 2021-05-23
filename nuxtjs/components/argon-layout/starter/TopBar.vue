<template>
    <div class="top_bar navbar-main clearfix">
          <ul>
            <li class="">
                <div class="right_top">
                     <ul class="call_button">
                        <li class="call">
                            <i class="fas fa-phone-alt"></i> হটলাইন
                        </li>
                        <li class="number">
                            ০১৭০০ ১২৩৪৫৬
                        </li>
                    </ul>
                </div>
            </li>
            <li class="" v-show="!isMobile">
                <div class="trapezoid">
                     <ul v-if="$auth.loggedIn">
                        <li><nuxt-link to="/"><i class="fas fa-home"></i></nuxt-link></li>
                        <li><nuxt-link to="/dashboard/profile">{{$auth.user.name.substring(0,5)+".."}}</nuxt-link></li>
                        <li><a href="#" @click="logout">লগআউট</a></li>
                    </ul>
                     <ul v-else>
                        <li><nuxt-link to="/"><i class="fas fa-home"></i></nuxt-link></li>
                        <li><nuxt-link to="/register">নিবন্ধন</nuxt-link></li>
                        <li><nuxt-link to="/login">লগইন</nuxt-link></li>
                    </ul>
                </div>
            </li>
          </ul>
        </div>
</template>
<script>
import { isMobile } from 'mobile-device-detect';
export default {
  name: 'Topbar',
  
  data () {
    return {
      isMobile: isMobile,
    }
  },
  methods: {
    async logout() {
      await this.$auth.logout()
    }
  }
}
</script>
<style scoped>
.dropdown-menu-custom{

}
@media (max-width: 767px){
    .top_bar{
        margin-bottom: 50px;
    }
}
.trapezoid {
    border-bottom: 37px solid rgb(117,171,40);
    border-left: 9px solid transparent;
    border-right: 0px solid transparent;
    height: 0;
    width: 250px;
    right: -14px;
}
@media (max-width: 767px){
    .trapezoid{
        width: 240px;
    }
}
.right_top{
    margin-right: 41px;
}
@media (max-width: 767px){
    .right_top{
        margin-right: 0px;
    }
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  float: right;
}
.trapezoid ul {
    margin-top: 8px;
    margin-right: 33px;
    font-size: 13px;
    color: #fff;
}
li {
  float: left;
}
li>a {
  padding: 0 15px 0 15px;
  color: #fff;
  font-weight: 500;
}
.call_button>.call{
    background: rgb(117,171,40);
    color: #fff !important;
    margin-top: 4px;
    padding: 5px;
    font-size: 12px;
    padding-left: 20px;
    padding-right: 15px;
    border-bottom-left-radius: 20px;
}
@media (max-width: 767px){
    .call{
        margin-left: 10px;
    }
}
.call_button>.call>i{
    position: absolute;
    /*font-size: 39px;*/
    /*margin-top: -5px;*/
    /*margin-left: -16px;*/
    color: rgb(58,170,53);
    font-weight: bold;
    text-shadow: 1px 1px 4px #fff;
    font-size: 30px;
    margin-top: -5px;
    margin-left: -30px;
    transform: rotate(15deg);
}
.call_button>.number{
    background: #fff;
    color: #0b0a0a !important;
    padding: 5px;
    border-radius: 0px 10px 10px 0px;
    border: 1px solid #b1a8a8;
    font-size: 11px;
    margin-top: 4px;
}

</style>