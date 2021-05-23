<template>
  <div>
    <div class="row">
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Nominee's Name
            <span class="required">*</span>
          </label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="nominee.name"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Relation
            <span class="required">*</span>
          </label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="nominee.relation"
          />
        </div>
      </div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Phone/Mobile
            <span class="required">*</span>
          </label>
          <input
            id="firstName"
            name="National ID"
            class="form-control col-md-8"
            type="text"
            v-model="nominee.phone"
          />
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-5 align-self-center">
        <div class="form-group row">
          <label class="labels col-md-4" for="#firstName">
            Address
            <span class="required">*</span>
          </label>
          <textarea
            class="form-control col-md-8"
            id="exampleFormControlTextarea1"
            v-model="nominee.address"
            rows="2"
          ></textarea>
        </div>
      </div>
      <div class="col-md-4 row">
        <button @click="saveData" type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save
        </button>
        <button type="button" class="btn btn-primary btn-sm">
          <i class="fas fa-save"></i> Save & next
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>
    <div style="height:290px;"></div>
  </div>
</template>
<script>
// import address from "~/components/dashboard/profile/large/address"

export default {
  data() {
    return {
      nominee: {
        address: '',
        phone: '',
        name: '',
        relation: ''
      }
    }
  },
  mounted() {
    this.get()
  },
  methods: {
    saveData() {
      try {
        var data = {
          nominee: this.nominee,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.nominee = response.data.nominee
            this.$notify.success({
              title: 'Nominee info',
              message: 'Succesfully Update'
            })
          })
          .catch(error => {})
      } catch (error) {}
    },
    get() {
      try {
        this.$axios
          .get('api/contacts/show/' + this.$auth.user.id)
          .then(response => {
            if (response.data.nominee) {
              this.nominee = response.data.nominee
            }
          })
          .catch(error => {})
      } catch (error) {}
    }
  }
}
</script>
<style scoped>
.required {
  color: red;
}
</style>