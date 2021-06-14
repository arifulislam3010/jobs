<template>
    <div class="wrapper">
        <div class="container">
            <div class="col-md-12">
                <div class="card " data-image="profile-image">
                    <div class="card-header"  v-if="list.image">
                        <div class="card-image">
                        <a href="javascript:;">
                            <img style="width:100%;height:300px;" class="img" :src="list.image">
                        </a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <p v-html="list.content"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
  export default {
    components: {
    },
    data() {
      return {
       
      }
    },
    mounted(){
      this.get();
      
    },
    computed: mapGetters({
      list: 'frontent/post'
    }),
    methods: {
      async get () {
        try {
          await this.$store.dispatch('frontent/get_post',this.$route.params.others)
        } catch (e) {
          
        }
      },
    }
  }
</script>