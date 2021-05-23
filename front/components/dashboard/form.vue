<template>
    <div v-if="openModalStatus">
        <div class="black_overlay" @click="closeModal"></div>
        <div class="content_overlay card bg-gradient-secondary shadow">
            <div  class="cur_content_block">
                <ul class="nav nav-pills"  style="position: fixed;top: 8%;right: 4%; z-index: 1;" id="tabs_2" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link  active" id="home-tab" @click="closeModal">
                            <span class="nav-link-icon d-block" >
                            <i class="fas fa-times"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <div  id="content_id" class="content_details">
                    <!-- <div style="width:100%;height:100%;"> -->
                        <object :data="list.file_name+'#toolbar=0&navpanes=0&scrollbar=0'" type="application/pdf" width="100%" height="100%"></object>
                    <!-- </div> -->
                </div>
            </div>
        </div>   
    </div>
</template>

<script>
    
    export default {
        name:'form-download',
        components: {
        },
        props: [],
        data(){
            return{
                openModalStatus:false,
                list:{}
            }
        },
        mounted(){
          
          
        },
        methods: {
            closeModal(){
                this.openModalStatus = false
            },
            openModal(list){
                this.list = list;
                this.openModalStatus = true
            }
        }
    }
</script>

<style scoped>
    .book22{
        background-color: #fde621;
    }
    .e-book22{
        background-color: #66CCCC;
    }
    
    .content_details{
        position: relative;
        width: 100%;
        left: 0px;
        top: 0px;
        /* padding-bottom: 60px; */
        height: 100%;
        /* overflow-y: auto; */
        transition: all 0.4s;
    }
    .black_overlay{
        position: fixed;
        background-color:#91978ea1;
        width: 100%; height: 100%;
        transition: all 0.4s;
        z-index: 102;
        top:0px;
        left:0px;
    }
    .content_overlay{
        position: fixed;        
        width: 90%;
        height: 80%;
        left: 5%;
        top: 10%;
        transition: all 0.4s;
        z-index: 103;        
    }
    .content_overlay .close_block{
        padding: 10px 15px;
        background-color: rgb(117,171,40);
        color: #ffffff;
    }
    .content_overlay .close_block .title{
        font-size: 16px; width: calc(100% - 30px);
    }
    .content_overlay .close_block .close_btn{
        display: inline-block;
        cursor: pointer;
        width: 20px;
        height: 24px;
        text-align: center;
        line-height: 26px;
    }    
    .cur_content_block{
        border-bottom: 1px solid #ddd;
        background-color: #fff;
        /*  */
        /* background-image:url('../../../assets/image/tenor.gif'); */
        background-size:cover;
        padding: 5px;
        height: 100%;
        overflow: auto;
        z-index: 1;
        position: relative;
        /* background-color: green; */
        border: 6px solid #78c621;
    }

    .cur_content_block .nav-pills .nav-link.active {
        background-color: #78c621;
        /* color:#fff; */
    }
    /* width */
#content_id::-webkit-scrollbar {
  width: 5px;
}

/* Track */
#content_id::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
#content_id::-webkit-scrollbar-thumb {
  background: #93f186; 
}

/* Handle on hover */
#content_id::-webkit-scrollbar-thumb:hover {
  background: #61cc52; 
}
    .common-video{
        /* background: #af7e44 url("../../../../assets/background/2.jpg")  no-repeat;   */
        background-color: #fff;
        background-size:cover;
        background-position: center;
    }

    .common-p-guideline{
        /* background: #af7e44 url("../../../../assets/background/2.jpg")  no-repeat;   */
        background-color: #fd9800;
        background-size:cover;
        background-position: center;
    }

    .common-artwork{
        /* background: #af7e44 url("../../../../assets/background/2.jpg")  no-repeat;   */
        background-color: #ff1ab3;
        background-size:cover;
        background-position: center;
    }
    .common-game{
        background-color: #05b8cc;
        background-size:cover;
        background-position: center;
    }

    #book_shelf::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #book_shelf::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #fde621; 
        border-radius: 5px;
        
    }
    
    /* Handle */
    #book_shelf::-webkit-scrollbar-thumb {
        background: #fde621; 
        
        border-radius: 5px;
    }

    /* Handle on hover */
    #book_shelf::-webkit-scrollbar-thumb:hover {
        background: #0b854a; 
    }

    #video_list::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #video_list::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #3b2e1c; 
        border-radius: 5px;
        
    }
    
    /* Handle */
    #video_list::-webkit-scrollbar-thumb {
        background: #61cc52; 
        
        border-radius: 5px;
    }

    /* Handle on hover */
    #video_list::-webkit-scrollbar-thumb:hover {
        background: #93f186;
    }

   
     

     #game_list::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #game_list::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #3b2e1c; 
        border-radius: 5px;
        
    }
    
    /* Handle */
    #game_list::-webkit-scrollbar-thumb {
        background: #038796; 
        border-radius: 5px;
    }

    /* Handle on hover */
    #game_list::-webkit-scrollbar-thumb:hover {
        background: #036e7a;
    }

    
     #art_list::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #art_list::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #3b2e1c; 
        border-radius: 5px;
        
    }
    
    /* Handle */
    #art_list::-webkit-scrollbar-thumb {
        background: #7886c2; 
        border-radius: 5px;
    }

    /* Handle on hover */
    #art_list::-webkit-scrollbar-thumb:hover {
        background: #53619e;
    }

     #pg_list::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #pg_list::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #3b2e1c; 
        border-radius: 5px;
        
    }
    
    /* Handle */
    #pg_list::-webkit-scrollbar-thumb {
        background: #8553b4; 
        border-radius: 5px;
    }

    /* Handle on hover */
    #pg_list::-webkit-scrollbar-thumb:hover {
        background: #7648a1;
    }

    #ebook_shelf::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    #ebook_shelf::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #3b2e1c; 
        border-radius: 5px;
        
    }
    
    /* Handle */
    #ebook_shelf::-webkit-scrollbar-thumb {
        background: #53abab; 
        
        border-radius: 5px;
    }

    /* Handle on hover */
    #ebook_shelf::-webkit-scrollbar-thumb:hover {
        background: #449b9b; 
    }

</style>