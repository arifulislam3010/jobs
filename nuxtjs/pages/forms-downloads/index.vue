<template>
  <div>
    <div class="team-5">
      <div class="container table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th style="font-size:14px !important;">#</th>
              <th style="font-size:14px !important;">শিরোনাম</th>
              <th style="font-size:14px !important;">ডাউনলোড</th>
            </tr>
          </thead>
          <tbody v-if="lists">
            <tr v-for="(list,key) in this.lists" v-bind:key="key">
              <th scope="row">{{seria[key]}}</th>
              <td>{{list.title.substring(0,60)+".."}}</td>
              <td>
                <button
                  style="background-color:#74CE35"
                  type="button"
                  @click="download(list.file_name)"
                  class="btn btn-sm btn-primary"
                >ডাউনলোড</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
// Vue.component('pagination', require('laravel-vue-pagination'));
import { mapMutations, mapGetters } from 'vuex'
export default {
  components: {},
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
        ' ১৫'
      ]
    }
  },
  mounted() {
    this.get()
  },
  computed: mapGetters({
    lists: 'frontent/downloads'
  }),
  methods: {
    download(url) {
      alert(url)
      // window.open(url, '_blank')
    },
    // forceFileDownload(response) {
    //   const url = window.URL.createObjectURL(new Blob([response.data]))
    //   const link = document.createElement('a')
    //   link.href = url
    //   link.setAttribute('download', 'file.png') //or any other extension
    //   document.body.appendChild(link)
    //   link.click()
    // },

    downloadWithAxios(url) {
      this.$axios({
        method: 'get',
        url: url,
      })
        .then(response => {
          this.forceFileDownload(response)
        })
        .catch(() => console.log('error occured'))
    },
    async get() {
      let search = { category: 2, limit: 4 }
      try {
        await this.$store.dispatch('frontent/get_downloads', search)
      } catch (e) {}
    }
  }
}
</script>