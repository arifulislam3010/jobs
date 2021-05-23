<template>
  <div>
    <div v-if="lists" class="container card">
      <vs-collapse accordion >
        <vs-collapse-item  v-for="(item,key) in lists" :key="key">
          <div slot="header">
            <h5>{{item.headline}}</h5>
          </div>
          <div v-if="item.image" style="width:100%;height:300px;">
            <img style="height:100%;width:100%" :src="item.image" alt="">
          </div>
          <div v-html="item.content">

          </div>
        </vs-collapse-item>
        </vs-collapse>
    </div>
    <div v-else> 
      <p style="margin:20px auto;font-size:30px;color:#888;text-align:center">কোন তথ্য পাওয়া যায় নি</p>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css'
import 'material-icons/iconfont/material-icons.css';
Vue.use(Vuesax, {})

export default {
    data() {
      return {
        text:"hello world",
        lists:''
      }
    },
    mounted(){
      this.get();
    },
    methods: {
      async get () {
          this.$axios.get('api/get-guide').then(response =>{
            this.lists = response.data
          })
      },
    }
  }
</script>