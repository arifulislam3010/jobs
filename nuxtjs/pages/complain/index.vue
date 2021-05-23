<template>
    <div class="container-fluid">
		<div class="row">
			<div class="col-md-8 ml-auto mr-auto text-center mt-5">
				<h1 class="title">অভিযোগ ফরম</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 mx-auto card bg-secondary">
				<!-- <form class="card bg-secondary p-3"> -->
					<div class="card-body">
						<div class="form-group">
							<label>আপনার নাম লিখুন</label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-circle-08"></i></span>
								</div><input aria-label="আপনার নাম লিখুন..." v-model="list.name" class="form-control" placeholder="First Name..." type="text">
							</div>
						</div>
						<!-- <p  v-if="errors.has('name')" class="validation_message">* {{ errors.first('name') }}</p> -->
						<div v-if="this.errors.errors">
							<p  v-for="(error,k) in this.errors.errors.name" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="form-group">
							<label>আপনার ইমেল লিখুন </label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="ni ni-email-83"></i></span>
								</div><input class="form-control" v-model="list.email" placeholder="আপনার ইমেল লিখুন..." type="text">
							</div>
						</div>
						<!-- <p  v-if="errors.has('email_phone')" class="validation_message">* {{ errors.first('email_phone') }}</p> -->
						<div v-if="this.errors.errors">
							<p  v-for="(error,k) in this.errors.errors.email" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="form-group">
							<label>আপনার ফোন লিখুন </label>
							<div class="input-group input-group-alternative">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone-square-alt"></i></span>
								</div><input class="form-control" v-model="list.phone" placeholder="আপনার ফোন লিখুন..." type="text">
							</div>
						</div>
						<!-- <p  v-if="errors.has('email_phone')" class="validation_message">* {{ errors.first('email_phone') }}</p> -->
						<div v-if="this.errors.errors">
							<p  v-for="(error,k) in this.errors.errors.phone" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="form-group">
							<label>আপনার অভিযোগ লিখুন </label> 
							<textarea class="form-control form-control-alternative" v-model="list.message" id="message" name="message" rows="6" placeholder="আপনার অভিযোগ লিখুন..."></textarea>
						</div>
						<!-- <p  v-if="errors.has('message')" class="validation_message">* {{ errors.first('message') }}</p> -->
						<div v-if="this.errors.errors">
							<p  v-for="(error,k) in this.errors.errors.message" v-bind:key="'n'+k" class="validation_message">* {{ error }}</p>
						</div>
						<div class="row">
							<div class="col-md-6 ml-auto">
								
								<button v-if="saving" class="btn btn-primary pull-right" type="submit"> <i class="fa fa-cog fa-spin"></i> জমা দিন</button>
								<button v-else class="btn btn-primary pull-right" @click="submit" type="submit">জমা দিন</button>
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
import pagination from 'laravel-vue-pagination'
import users from "~/components/custom/user/list.vue";
  export default {
    components: {
      users,
      pagination
    },
    data() {
      return {
		  list:{name:'',email:'',phone:'',message:'',type:1},
		  errors:{},
		  saving:false,
      }
    },
    mounted(){
    //   this.get();
    },
    computed: mapGetters({
      lists: 'frontent/users'
    }),
    methods: {

		
      async submit () {
		  this.saving = true;
        await this.$axios.post('complain',this.list).then(response => {
			this.saving = false;
			this.errors = {};
			this.list.name = '';
			this.list.email_phone = '';
			this.list.message = '';
			this.$notify.success({
				title: 'অভিযোগ',
				message: 'অভিযোগ সফলভাবে জমা দেওয়া হয়েছে'
			});
		})
		.catch(error => {
			this.saving = false;
			this.errors = error.response.data;
			this.$notify.error({
				title: 'Error',
				message: 'Some Thing Probelm'
			});
		});
      },
    }
  }
</script>