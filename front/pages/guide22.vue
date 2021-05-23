<template>
  <div id="flip" style="background-color:#333333">
    <div style="background-color: #333333; height:20px;"></div>
    <flipbook
      class="flipbook clearfix"
      :pages="pages"
      :startPage="pageNum"
      v-slot="flipbook"
      @flip-left-start="onFlipLeftStart"
    >
      <div class="action-bar">
        <i
          class="fas fa-chevron-circle-left fa-2x"
          :class="{ disabled: !flipbook.canFlipLeft }"
          @click="flipbook.flipLeft"
        ></i>
        <i
          :class="{ disabled: !flipbook.canZoomIn }"
          @click="flipbook.zoomIn"
          class="fas fa-plus-circle fa-2x"
        ></i>
        <span class="page-num" id="numb">
          <l style="color:white">Page {{ flipbook.page }} of {{ flipbook.numPages }}</l>
        </span>
        <i
          :class="{ disabled: !flipbook.canZoomOut }"
          @click="flipbook.zoomOut"
          class="fas fa-minus-circle fa-2x"
        ></i>
        <i
          :class="{ disabled: !flipbook.canFlipRight }"
          @click="flipbook.flipRight"
          class="fas fa-chevron-circle-right fa-2x"
        ></i>
      </div>
    </flipbook>
  </div>
</template>
<script>
export default {
  data() {
    return {
      pages: [
        null,
        'http://api.immigration.orangebd.com/uploads/images/1.jpg',
        'http://api.immigration.orangebd.com/uploads/images/2.jpg',
        'http://api.immigration.orangebd.com/uploads/images/3.jpg',

        'http://api.immigration.orangebd.com/uploads/images/4.jpg',

        'http://api.immigration.orangebd.com/uploads/images/5.jpg',

        'http://api.immigration.orangebd.com/uploads/images/6.jpg',

        'http://api.immigration.orangebd.com/uploads/images/7.jpg',
        'http://api.immigration.orangebd.com/uploads/images/8.jpg',
        'http://api.immigration.orangebd.com/uploads/images/9.jpg',
        'http://api.immigration.orangebd.com/uploads/images/10.jpg',
        'http://api.immigration.orangebd.com/uploads/images/11.jpg',
        'http://api.immigration.orangebd.com/uploads/images/12.jpg',
        'http://api.immigration.orangebd.com/uploads/images/13.jpg',
        'http://api.immigration.orangebd.com/uploads/images/14.jpg',
        'http://api.immigration.orangebd.com/uploads/images/15.jpg',
        'http://api.immigration.orangebd.com/uploads/images/16.jpg',
        'http://api.immigration.orangebd.com/uploads/images/17.jpg',
        'http://api.immigration.orangebd.com/uploads/images/18.jpg',
        'http://api.immigration.orangebd.com/uploads/images/19.jpg',
        'http://api.immigration.orangebd.com/uploads/images/20.jpg',
        'http://api.immigration.orangebd.com/uploads/images/21.jpg',
        'http://api.immigration.orangebd.com/uploads/images/22.jpg',
        'http://api.immigration.orangebd.com/uploads/images/23.jpg',
        'http://api.immigration.orangebd.com/uploads/images/24.jpg',
        'http://api.immigration.orangebd.com/uploads/images/25.jpg',
        'http://api.immigration.orangebd.com/uploads/images/26.jpg',
        'http://api.immigration.orangebd.com/uploads/images/27.jpg',
        'http://api.immigration.orangebd.com/uploads/images/28.jpg',
        'http://api.immigration.orangebd.com/uploads/images/29.jpg',
        'http://api.immigration.orangebd.com/uploads/images/30.jpg',
        'http://api.immigration.orangebd.com/uploads/images/31.jpg',
        'http://api.immigration.orangebd.com/uploads/images/32.jpg',
        'http://api.immigration.orangebd.com/uploads/images/33.jpg',
        'http://api.immigration.orangebd.com/uploads/images/34.jpg',
        'http://api.immigration.orangebd.com/uploads/images/35.jpg',
        'http://api.immigration.orangebd.com/uploads/images/36.jpg',
        'http://api.immigration.orangebd.com/uploads/images/37.jpg',
        'http://api.immigration.orangebd.com/uploads/images/38.jpg',
        'http://api.immigration.orangebd.com/uploads/images/39.jpg',
        'http://api.immigration.orangebd.com/uploads/images/40.jpg',
        null
      ],
      pageNum: null
    }
  },
  methods: {
    onFlipLeftStart(page) {
      console.log('flip-left-start', page)
    }
  }
}
</script>

<style scoped>
i {
  width: 40px;
  height: 20px;
  size: 30px;
  cursor: pointer;
  color: white;

  margin-right: 1em;
}
i:hover {
  color: black;
}

#numb {
  margin-right: 3em;
}

#retro {
  margin-bottom: 15px;
  background-color: black;
}
.flipbook {
  width: 87%;
  height: 90vh;
  /* margin:0 auto; */
  /* justify-content: center;
  align-items: center;
  text-align: center; */
  /* margin-left: -45px; */

}
.action-bar .btn[data-v-4313af5a] {
  font-size: 30px;
  background: white;
}

.action-bar .page-num {
  font-size: 12px;
  margin-left: 10px;
}

#flip {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  height: 600px;
}

a {
  color: inherit;
}

.action-bar {
  width: 100%;
  height: 30px;
  margin-top: 20px;
  margin-bottom: -15px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.action-bar .btn {
  font-size: 30px;
  color: #999;
}

.action-bar .btn svg {
  bottom: 0;
}

.action-bar .btn:not(:first-child) {
  margin-left: 10px;
}

.has-mouse .action-bar .btn:hover {
  color: #ccc;
  filter: drop-shadow(1px 1px 5px #000);
  cursor: pointer;
}

.action-bar .btn:active {
  filter: none !important;
}

.action-bar .btn.disabled {
  color: #666;
  pointer-events: none;
}

.action-bar .page-num {
  font-size: 12px;
  margin-left: 10px;
}

.flipbook .viewport {
  width: 90vw;
  /* height: calc(100vh - 50px - 40px); */
}

.flipbook .bounding-box {
  box-shadow: 0 0 20px #000;
}

.credit {
  font-size: 12px;
  line-height: 20px;
  margin: 10px;
}
</style>