<template>
    <div id="wrapper" class="d-flex flex-column" style="background: #f4f5f7;">
        <div style="background: #fff;">
        <TopBar></TopBar>
        <header class="header-global">
            <starter-header></starter-header>
        </header>
        </div>
        <main class="flex-fill position-relative" >
          
          <div class="wrapper">
            <div class="bg-secondary">
              <div class="bg-white card mb-0">
                <div class="row">
                  <div class="col-md-2 left">
                    <div  style="padding-left:30px;padding-top:0px;">
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
        <footer class="footer">
            <starter-footer></starter-footer>
        </footer>
    </div>
</template>

<script>
import StarterHeader from "~/components/argon-layout/starter/StarterHeader";
import TopBar from "~/components/argon-layout/starter/TopBar";
import StarterFooter from "~/components/argon-layout/starter/StarterFooter";;
import AppHeader from "~/components/argon-layout/AppHeader";
import DashboardFooter from "~/components/dashboard/footer";
import DashboardNav from "~/components/dashboard/nav";

export default {
  // middleware: 'auth',
  components: {
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
