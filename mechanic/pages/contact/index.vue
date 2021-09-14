<template>
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-8 ml-auto mr-auto text-center mt-5">
				<h1 class="title">Contact with us</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mx-auto card bg-secondary">
				<!-- <form class="card bg-secondary p-3"> -->
					<div class="card-body">
						<div class="form-group">
							<label>আপনার নাম </label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-circle-08"></i></span>
								</div><input aria-label="আপনার নাম লিখুন" name="name" v-validate="'required'" v-model="list.name" class="form-control" placeholder="আপনার নাম লিখুন" type="text">
							</div>
						</div>
						<p  v-if="errors.has('name') && check_status" class="validation_message">* নাম প্রয়োজন</p>
						<div v-if="form_errors.errors">
							<p  v-for="(error,k) in form_errors.errors.name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="form-group">
							<label>আপনার ইমেইল  </label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-email-83"></i></span>
								</div><input @keyup="removeError('email')" class="form-control" v-model="list.email" v-validate="'required'" name="email" placeholder="আপনার ইমেল লিখুন" type="email">
							</div>
						</div>
						<p  v-if="errors.has('email') && check_status" class="validation_message">* ইমেইল প্রয়োজন</p>
						<div v-if="form_errors.errors">
							<p  v-for="(error,k) in form_errors.errors.email" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="form-group">
							<label>আপনার ফোন </label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
								</div><input @keyup="removeError('phone')" class="form-control" v-model="list.phone" placeholder="আপনার ফোন লিখুন" name="phone" v-validate="'required'" type="text">
							</div>
						</div>
						<p  v-if="errors.has('phone') && check_status" class="validation_message">* ফোন প্রয়োজন</p>
						<div v-if="form_errors.errors">
							<p  v-for="(error,k) in form_errors.errors.phone" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="form-group">
							<label>আপনার মতামত লিখুন </label> 
							<textarea class="form-control form-control-alternative" v-model="list.message" v-validate="'required'" name="message" rows="6" placeholder="আপনার মতামত লিখুন"></textarea>
						</div>
						<p  v-if="errors.has('message') && check_status" class="validation_message">* মতামত প্রয়োজন</p>
						<div v-if="form_errors.errors">
							<p  v-for="(error,k) in form_errors.errors.message" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="row">
							<div class="col-md-6 ml-auto">
								<button style="background-color:#75ab28" v-if="saving" class="btn btn-primary pull-right" type="submit"> <i class="fa fa-cog fa-spin"></i> জমা দিন</button>
								<button style="background-color:#75ab28" v-else class="btn btn-primary pull-right" @click="validate()" type="submit">জমা দিন</button>
							</div>
						</div>
					</div>
				<!-- </form> -->
			</div>
		</div>
	</div>
</template>
<script>
import { mapMutations, mapGetters } from 'vuex'
import * as VeeValidate from 'vee-validate'
import Vue from 'vue'
Vue.use(VeeValidate)
  export default {
    data() {
      return {
		list:{name:'',email:'',phone:'',message:'',type:2},
		saving:false,
		form_errors:{},
		validate_status:false,
		check_status:true,
      }
    },
    methods: {
		validate(){
			this.check_status = true
			this.$validator.validateAll().then(result => {
				if(result){
					this.validate_status = true
					this.submit()
				}
				else{
					this.validate_status = false
				}
			})
		},
      async submit () {
		if(this.validate_status){
			this.saving = true;
			await this.$axios.post('complain',this.list).then(response => {
				this.saving = false;
				this.check_status = false
				this.list = {name:'',email:'',phone:'',message:'',type:1},
				this.$notify.success({
					title: 'মতামত',
					message: 'মতামত সফলভাবে জমা দেওয়া হয়েছে'
				});
			})
			.catch(error => {
				this.saving = false;
				this.form_errors = error.response.data;
			});
		}
	  },
	  removeError(field){
		if(this.form_errors.errors){
			delete this.form_errors.errors[field];
			this.check_status = true
		}
	  }
    }
  }
</script>