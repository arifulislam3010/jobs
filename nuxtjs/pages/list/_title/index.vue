<template>
    <div>
        <div class="team-5">
        <div class="container">
          <!-- <div class="row">
            <div class="col-md-8 mx-auto text-center mb-5">
              <h3 class="display-3">Meet our awesome team</h3>
              <p class="lead">People are so scared to lose that they don't even try. Like, one thing people can't say is that I'm not trying, and I'm not trying my hardest, and I'm not trying to do the best way I know how.</p>
            </div>
          </div> -->
          <div v-if="lists.data" class="row">
            <!-- <users v-for="(list,key) in this.lists" v-bind:key="key" :user="list"></users> -->
            <users  :users="this.lists"></users>
            <pagination :data="this.lists" @pagination-change-page="get" :limit="1"></pagination>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination'
import users from "~/components/custom/user/list.vue";
  export default {
    components: {
      users,
      pagination
    },
    data() {
      return {
        type:3,
      }
    },
    mounted(){
      if(this.$route.params.title == 'recruiting-agency'){
          this.type = 3;
      }
      if(this.$route.params.title == 'training-centers'){
          this.type = 4;
      }
      if(this.$route.params.title == 'financial-organization'){
          this.type = 5;
      }
      if(this.$route.params.title == 'important-embassy'){
          this.type = 7;
      }
      this.get();
    },
    computed: mapGetters({
      lists: 'frontent/users'
    }),
    methods: {
      async get (page = 1) {
        // this.$nuxt.$loading.start();
          let data = {
              role:this.type,
          }
        try {
          await this.$store.dispatch('frontent/get_users',{data,page})
        } catch (e) {
          
        }
      },
    }
  }
</script>