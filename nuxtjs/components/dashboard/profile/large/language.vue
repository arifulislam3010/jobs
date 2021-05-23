<template>
  <div>
    <div class="row" v-for="(language,key) in languages" :key="key">
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label style="font-size:13px;" for="inputPassword" class="col-md-4 labels">Language:</label>
          <div class="col-md-8">
              <multiselect
                v-model="language.language"
                placeholder="Select Language"
                label="name"
                track-by="id"
                :options="language_list"
              ></multiselect>
            </div>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Oral Skill:</label>
          <select v-model="language.oral_skill" class="form-control col-md-8" id="exampleFormControlSelect1">
            <option value="">Oral Skill</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Workable">Workable</option>
          </select>
        </div>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-3 align-self-center">
        <div class="form-group row">
          <label for="inputPassword" class="col-md-4 labels">Writing Skill</label>
          <select v-model="language.writing_skill" class="form-control col-md-8" id="exampleFormControlSelect1">
            <option value="">Writing Skill</option>
            <option value="Excellent">Excellent</option>
            <option value="Good">Good</option>
            <option value="Workable">Workable</option>
          </select>
        </div>
      </div>
      <div class="col-md-1">
        <p @click="remove(key)" style="cursor:pointer">delete <i class="far fa-trash-alt"></i></p>
      </div>
    </div>
    <div class="row ">
        <div class="col-md-12 text-center">
            <button @click="addMore()" class="btn btn-secondary btn-sm">+ Add More Language</button>
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
    <div style="height:290px;"></div>
  </div>
</template>
<script>
import Multiselect from 'vue-multiselect'
export default {
  components: {
    Multiselect
  },
  data(){
    return{
      language_list:[],
      languages:[{language:{},writing_skill:'',oral_skill:'',}],
      language:{}
    }
  },
  methods:{
    async getLanguage() {
      this.$axios
        .get('api/get-language')
        .then(response => {
          this.language_list = response.data
        })
        .catch(error => {})
    },
    addMore(){
      var data = {language:{},writing_skill:'',oral_skill:'',};
      this.languages.push(data)
    },
    remove(index){
       this.languages.splice(index,1)
    },
    saveData() {
      try {
        var data = {
          languages: this.languages,
          user_id: this.$auth.user.id
        }
        this.$axios
          .put('contacts/', data)
          .then(response => {
            this.languages = response.data.languages
            this.$notify.success({
              title: 'Language info',
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
            console.log("okkkk")
            console.log(response)
            if (response.data.languages) {
              this.languages = response.data.languages
            }
          })
          .catch(error => {})
      } catch (error) {}
    }
  },
  mounted(){
    this.getLanguage(),
    this.get()
  }
}
</script>