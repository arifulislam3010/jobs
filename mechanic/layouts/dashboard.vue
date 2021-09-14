<template>
    <div id="wrapper" class="d-flex flex-column" style="background: rgb(239, 239, 239);">
        <div style="background: #fff;">
     
        <header class="header-global">
           <main-nav></main-nav>
        </header>
        </div>
        <main class="flex-fill position-relative" style="margin-top: 66px; padding:30px;">
          
          <div class="wrapper">
            <div class="bg-secondary">
              <div class="bg-white  mb-0">
                <div class="row">
                  <div class="col-md-2 left">
                    <div  style="position: relative;">
                      <DashboardNav></DashboardNav>
                    </div>
                  </div>
                    <div class="col-md-10 ml-auto right" style="top: 20px;padding-right:30px;">
                       <nuxt />
                     </div>
                  </div>
              </div>
            </div>
          </div>
        </main>
        <!-- <footer class="footer">
            <Footer></Footer>
        </footer> -->
    </div>
</template>

<script>
import Footer from '~/components/customDesign/Footer/Footer.vue'
import StarterHeader from "~/components/argon-layout/starter/StarterHeader";
import TopBar from "~/components/argon-layout/starter/TopBar";
import StarterFooter from "~/components/argon-layout/starter/StarterFooter";;
import AppHeader from "~/components/argon-layout/AppHeader";
import DashboardFooter from "~/components/dashboard/footer";
import DashboardNav from "~/components/dashboard/nav";
import MainNav from '~/components/customDesign/navBar/index.vue'
export default {
  // middleware: 'auth',
  components: {
    MainNav,
    Footer,
    StarterHeader,
    TopBar,
    StarterFooter,
    AppHeader,
    DashboardFooter,
    DashboardNav
  }
};
</script>

<style>
body, #wrapper {
   min-height:100vh;
}

</style>
