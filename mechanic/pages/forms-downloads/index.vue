<template>
  <div>
      <div class="container">
        <div v-if="lists" style="width:100%;">
          <div @click="preview(list)" class="list-download" v-for="(list,key) in lists.data" v-bind:key="key">
            <span  style="padding:10px;"><b>{{list.title}}</b></span> <span style="float:right"><span title="ডাউনলোড"  @click="download(list.id)" class="download"><i class="fas fa-download"></i></span></span>
          </div>
        </div>
        <div  style="width:100%;" class="mt-2">
            <pagination :data="this.lists" @pagination-change-page="get" :limit="1"></pagination>
        </div>
      </div>
    <FormDownload ref="preview" />
  </div>
</template>
<script>
import pagination from 'laravel-vue-pagination'
import FormDownload from '~/components/dashboard/form.vue'

import { mapMutations, mapGetters } from 'vuex'
export default {
  components: {
    FormDownload,
    pagination
  },
  data() {
    return {
      seria: [
        '১',
        '২',
        '৩',
        '৪',
        '৫',
        '৬',
        '৭',
        '৮',
        '৯',
        '১০',
        '১১',
        '১২',
        '১৩',
        '১৪',
        '১৫'
      ],
      download_status:true
    }
  },
  mounted() {
    this.get()
  },
  computed: mapGetters({
    lists: 'frontent/downloads'
  }),
  methods: {
    preview(list){
      if(this.download_status){
        this.$refs.preview.openModal(list)
      }
    },
    download(id) {
      window.open('http://api.immigration.orangebd.com/api/frontend/content/download/'+id, '_blank')
      this.download_status = false;
      setTimeout(()=>{
        this.download_status = true
      },2000)
    },   
    async get(page=1) {
      let search = { category: 2, limit: 10, page}
      try {
        await this.$store.dispatch('frontent/get_downloads', search)
      } catch (e) {}
    }
  }
}
</script>
<style scoped>
.list-download{
  cursor: pointer;
  width:100;
  border-top:1.5px solid #f1f3f4;
  border-bottom:1.5px solid #f1f3f4;
  padding:10px;
  transition: 0.4s;
}
.list-download:hover{
  box-shadow: 0 10px 25px rgba(50,50,93,.1), 0 5px 10px rgba(0,0,0,.07);
  transition: 0.4s;
}
.download{
  transition: 0.4s;
  padding-right: 10px;
  opacity: 0;
}
.list-download:hover .download {
 opacity: 1;
}

.download:hover{
  padding:8px 10px;
  background:#d0dfe6;
  border-radius:100%;
}
</style>