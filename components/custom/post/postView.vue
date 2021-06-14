<template>
  <div class="modal fade bd-example-modal-lg"  :class="this.$parent.modalOpen?'show':''" id="exampleModal" :style="this.$parent.modalOpen?'display: block; overflow: scroll; padding-right: 17px;':''" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
	        <div class="modal-body p-5" style="font-size: 14px;">
	            <h5 class="modal-title mb-5" id="exampleModalLabel" v-if="post.type==1" style="width: 100%; text-align: center;">{{ post.headline }}</h5>
	            <span><b>Designation: </b> {{ post.designation }}</span><br>
	            <span><b>Deadline: </b> {{ post.expired_at }}</span><br>
	            <span><b>Job Description: </b> <span v-html="post.content"></span></span>
	        </div>
	        <div class="modal-footer p-3">
	        	<button type="button" class="btn btn-sm btn-secondary" @click="CloseModal" data-dismiss="modal">Close</button>
	        	<!-- <button type="button" class="btn btn-sm btn-success" @click="apply(post.id)" data-dismiss="modal">Apply</button> -->
	        </div>
        </div>
    </div>
  </div>
</template>
<script>
import Vue from 'vue'
export default {
  name: "postView",
  data() {
    return {
      post: ""
    }
  },
  mounted(){
  },
  methods: {
    CloseModal(){
      this.$parent.modalOpen = false;
    },
    openModal(data) {
      if(data!=''){
        this.post = Object.assign({},data);
        this.$parent.modalOpen = true;
      }
    },
    apply(id){
    	this.$parent.modalOpen = false;
    	this.$parent.applyView(id);
    }
  }
};
</script>