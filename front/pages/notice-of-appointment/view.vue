<template>
  <div class="modal fade bd-example-modal-lg"  :class="this.$parent.modalOpen?'show':''" id="exampleModal" :style="this.$parent.modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" v-if="post.type==1">Job Post</h5>
            <button type="button" class="close" @click="CloseModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
              
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" @click="CloseModal" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" v-if="loader"> <i class="fa fa-cog fa-spin"></i> Save changes</button>
        </div>
        </div>
    </div>
  </div>
</template>
<script>
import Vue from 'vue'
export default {
  name: "View",
  data() {
    return {
      post: ""
    }
  },
  mounted(){
    alert()
  },
  methods: {
    CloseModal(){
      this.$parent.modalOpen = false;
    },
    openModal(data) {
      alert('dd');
      // if(data!=''){
      //   this.post = Object.assign({},data);
      // }
      // this.$parent.modalOpen = true;
    },
  }
};
</script>