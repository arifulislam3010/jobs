<template>
    <div>
      <form>
        <div class="input-group">
          <!-- <input type="text" placeholder="" class="searchcustom" style="width:180px" title="search" id="gsc-i-id1" name="search">
          <div class="input-group-append">
            <button type="submit"><i class="fa fa-search"></i></button>
          </div> -->
          <!-- <button @click="guide()" style="width:180px;margin-left: -90px;">অভিবাসী গাইড বুক</button> -->
          <nuxt-link class="button" to="/guide" >অভিবাসী গাইড বুক</nuxt-link>
        </div>
      </form>
    </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
  export default {
    components: {
    },
    data() {
      return {
        slide: 0,
        sliding: null
      }
    },
    mounted(){
     
      
    },
    methods:{
      guide(){
        this.$router.push('/guide')
      }
    }
    
  }
</script>
<style scoped>
.search-container {
  float: right;
}
.searchcustom{
 width: 220px;
  padding: 6px;
  margin-top: 8px;
  border: none;
  border-radius: 10px 0px 0px 10px;
  margin-left: -90px;
  padding-left: 20px;
  font-size: 13px;
}
/* input[type=text] {
  width: 220px;
  padding: 6px;
  margin-top: 8px;
  border: none;
  border-radius: 10px 0px 0px 10px;
  margin-left: -90px;
  padding-left: 20px;
  font-size: 13px;
} */
.button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  padding: 6px 40px;
  /*margin-left: -5px;*/
  border-width: 0px;
  background-color: #fff;
  border-radius: 10px 10px 10px 10px;
  color:#000;
  margin-left: -99px;;
}
.search-container button:hover {
  background: #ccc;
}

@media (max-width: 767px){
  input[type=text] {
    width: 220px;
    margin-left: -110px;
  }
}
</style>