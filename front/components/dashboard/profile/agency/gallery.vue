<template>
    <div>
        <div class="row">
            <div class="col-md-2 mb-1" v-for="(url,key) in urls" :key="key">
                <div style="position:relative">
                    <img :src="url" alt="Norway" style="width:100%;height:170px;">
                    <div @click="removeImageData(key)" class="text-block">
                        <i class="fa fa-trash"></i>
                    </div>
                </div>
                <input class="form-control mt-1" v-model="names[key].name" type="text">
            </div>
            <div style="display:none" v-if="images.length == 0" class="col-md-12 text-enter ">
                <div  class="image_upload logo_upload pull-right col-md-2" @click="$refs.files.click()">
                        <p>এক বা একাধিক ছবি বাছাই করুন</p>
                        <i class="fas fa-cloud-upload-alt"></i>
                        <input
                        style="display: none"
                        v-on:change="imageChange"
                        type="file"
                        ref="files"
                        class="file-input"
                        name="image"
                        multiple
                    />
                </div>
            </div>
        </div>
        <div v-if="images.length > 0" class="row">
            <div class="col-md-12">
                <div  class="col-md-2 mt-2 pull-right">
                    <button style="background-color:#75ab28;" v-if="loader && images.length>0"  type="button" class=" btn btn-primary btn-block">
                        <i class="fa fa-cog fa-spin"></i> আপলোড
                    </button>
                    <button style="background-color:#75ab28;" v-if="!loader && images.length>0" @click="uploadMultipleImage()" type="button" class=" btn btn-primary btn-block">
                        আপলোড
                    </button>
                    <button style="background-color:#75ab28;" v-if="!loader && images.length == 0" disable type="button" class=" btn btn-primary btn-block">
                        আপলোড
                    </button>
                </div>
            </div>
        </div>
        <div  class="row">
            <div   class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <h6 style="margin-top:20px;">ফটোসমূহ: </h6>
                    </div>
                    <div class="col-md-9 ">
                        <button v-if="images.length == 0" class="pull-right" @click="$refs.files.click()" style="border:0;padding:10px;">+ আরো ছবি আপলোড করুন </button>
                    </div>
                </div>
                <hr style="width:100%;margin-top:-5px;">
            </div>
        </div>
        <div class="row">
            <!-- <div v-for="(list,key) in lists" :key="key">
                <p>Ok</p>
            </div> -->
            <div class="col-md-2" v-for="(list,key) in lists.data" :key="key">
                <div style="position:relative">
                    <img :src="list.image" alt="Norway" style="width:100%;height:170px;">
                    <div @click="deleteGallery(list.id,key)" class="text-block">
                        <i class="fa fa-trash"></i>
                    </div>
                    <p>{{list.name}}</p>
                </div>
            </div>
            <div class="col-md-12">
                <pagination :data="Object.assign({},lists)" @pagination-change-page="getResults"></pagination>
            </div>
        </div>
        <div>
  </div>
    </div>
</template>
<script>
import {mapState, mapGetters } from 'vuex'
import pagination from 'laravel-vue-pagination';
export default {
    data(){
        return{
            slide: 0,
            sliding: null,
            validate_status:false,
            image_message:false,
            check:true,
            checkImage:true,
            loader:false,
            image:'',
            url:'',
            name:'',
            images:[],
            urls:[],
            names:[],
        }
    },
    components:{
        pagination
    },
    computed: mapGetters({
        lists: 'admin/gallery/lists'
    }),
    methods:{
        imageChange(){
            this.images = []
            this.urls = []
            for(let i=0;i<this.$refs.files.files.length;i++){
                this.images.push(this.$refs.files.files[i]);
                this.urls.push(URL.createObjectURL(this.$refs.files.files[i]));
                this.names.push({name:''});
            }
        },
        removeImageData(index){
            this.images.splice(index,1)
            this.urls.splice(index,1)
            this.names.splice(index,1)
        },
        uploadMultipleImage(){
            this.loader = true
            var self = this;
            let formData = new FormData();
            let file = ''
            for(let i=0;i<this.images.length;i++){
                file = self.images[i]
                formData.append('files['+i+']',file)
                formData.append('names['+i+']',self.names[i].name)
            }

            formData.append('type','gallery')
            
            this.$store.dispatch('admin/gallery/add',formData).then(response=>{
                this.images = []
                this.urls = []
                this.names = []
                this.loader = false
            })
            .catch(error => {
                this.loader = false
            })
        },
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        },
        validate(){
            this.check = true;
            this.$validator.validateAll().then(result => {
                if(result){
                    this.validate_status = true;
                    this.saveData();
                }
                else{
                    this.validate_status = false;
                }

                if(this.image ==''){
                    this.image_message = true;
                }
            })
        },
        saveData() {
            if(this.validate_status && this.image !=''){
                this.loader = true
                var data = {
                    name:this.name,
                    image:this.image,
                    type:'gallery',
                }
                this.$store.dispatch('admin/gallery/add',data).then(response => {
                    this.check = false
                    this.loader = false
                    this.image = ''
                    this.url = ''
                    this.name = ''
                })
                .catch(error => {
                    this.loader = false
                })
            }
        },
        imageChanged(e) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = e => {
                this.image = e.target.result
                this.image_message = false;
            }
            this.url = URL.createObjectURL(e.target.files[0])
        },
        RemoveImage: function() {
            this.image = ''
            this.url = ''
            this.image_message = true;
        },
        async getResults(page=1){
            var data = {
                user_id:this.$auth.user.id,
                limit:6,
                type:'gallery',
                page:page
            }
            await this.$store.dispatch('admin/gallery/get',data) 
        },
        async deleteGallery(id,index){
            await this.$store.dispatch('admin/gallery/remove',{id,index}) 
        }
    },
    mounted(){
        this.getResults();
    }
}
</script>
<style scoped>
.required {
  color: red;
}
.logo_upload {
  border: 1px solid #ccc;
  width: 100%;
  height: 80px;
  background: #eceef0;
  text-align: center;
  cursor: pointer;
}
.image_upload p {
  margin-top: 10px;
  font-size: 12px;
}

.image_upload i {
  font-size: 14px;
}
.removeImage {
  position: absolute;
  right: 13px;
  top: 14px;
  color: var(--white);
  border: 1px solid;
  border-radius: 25px;
  padding: 4px 8px;
  background-color: #fb1212f5;
  font-size: 10px;
  font-family: cursive;
}
.fitimage {
  width: 50%;
  height: 100%;
  -o-object-fit: contain;
  object-fit: contain;
  background-color: #e6e6ef;
}
.text-block {
  position: absolute;
  top: 0px;
  right:0px;
  background-color: black;
  color: white;
  padding-left: 10px;
  padding-right: 10px;
  cursor: pointer;
}
</style>