<template>
  <div
    class="modal fade"
    :class="modalOpen?'show':''"
    id="exampleModal"
    :style="modalOpen?'display: block !important; overflow: scroll !important; padding-right: 17px !important;':''"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 v-if="list.type == 1">অভিযোগ</h4>
          <h4 v-if="list.type == 2">মতামত</h4>
          <button
            type="button"
            class="close"
            @click="CloseModal"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <div>
               {{list.messages}}
           </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            @click="CloseModal"
            data-dismiss="modal"
          >বাদ দিন</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      modalOpen: false,
      list: {type:0}
    }
  },
  methods: {
    openModal(list) {
      this.list = list
      this.modalOpen = true
    },
    CloseModal() {
      this.modalOpen = false
    }
  }
}
</script>
<style scoped>

.modal {
  background-color: rgb(0, 0, 0) !important; /* Fallback color */
  background-color: rgba(0, 0, 0, 0.4) !important; /* Black w/ opacity */
}

.clear {clear: both;}

</style>