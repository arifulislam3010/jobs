<template>
  <div>
    <div class="tables-2 mb-5">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                @input="getDistrictByID2()"
                v-model="division"
                placeholder="Select Division"
                label="division_name_eng"
                track-by="id"
                :options="divisions"
              ></multiselect>
            </div>
          </div>
          <div class="col-md-3">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                @input="getSubdistrict2()"
                v-model="district"
                placeholder="Select  District"
                label="district_name_eng"
                track-by="id"
                :options="districts"
              ></multiselect>
            </div>
          </div>
          <div class="col-md-3">
            <div style="padding-left:6px;">
              <multiselect
                style="margin-left:15px;"
                v-model="subdistrict"
                placeholder="Select  District"
                label="upazila_name_eng"
                track-by="id"
                :options="subdistricts"
              ></multiselect>
            </div>
          </div>
            <div class="col-md-3">
              <div class="form-group">
                <div class="input-group ">
                  <select v-model="search.migrate" class="form-control" id="exampleFormControlSelect1">
                    <option>Migration Status</option>
                    <option value="1">Migrated</option>
                    <option value="0">UnMigrated</option>
                  </select>
                </div>
              </div>
            </div>
            <div style="margin-left:20px;" class="col-md-3">
              <div class="form-group">
                <div class="input-group input-group-alternative mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="ni ni-zoom-split-in"></i>
                    </span>
                  </div>
                  <input
                    class="form-control form-control-alternative"
                    v-model="search.search"
                    placeholder="Search"
                    type="text"
                  />
                </div>
              </div>
            </div>
            <div style="margin-left:20px;" class="col-md-1">
              <button
                style="float: right;margin: 3px;"
                @click="get()"
                type="button"
                class="btn btn-primary"
              >Search</button>
            </div>
          </div>
          <div>
            <button
              v-if="usera.length>0"
              style="float: right;margin: 3px;"
              @click="openMigrateModal()"
              type="button"
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#exampleModal"
            >Migration</button>
            <div class="table-responsive mb-0">
              <table class="table table-pricing">
                <tbody>
                  <tr class="bg-primary">
                    <td class="text-white">
                      <label>
                        <b-form-checkbox
                          @change="alluser"
                          :id="'s'+key"
                          v-model="activate_status"
                          unchecked-value
                        ></b-form-checkbox>
                      </label>
                    </td>
                    <td class="text-white">
                      <b>User Name</b>
                    </td>
                    <td>
                      <b>Email/phone</b>
                    </td>
                    <td>
                      <b>Address</b>
                    </td>
                    <td>
                      <b>Migration Status</b>
                    </td>
                    <td>
                      <b>Migration Date</b>
                    </td>
                    <td>
                      <b>Action</b>
                    </td>
                  </tr>
                  <tr v-for="(list,key) in this.lists.data" v-bind:key="key">
                    <td>
                      <label>
                        <b-form-checkbox :id="key" v-model="usera" :value="list.id" unchecked-value></b-form-checkbox>
                      </label>
                    </td>
                    <td>{{list.name}}</td>
                    <td class="text-center">
                      {{list.email}}
                      <br />
                      {{list.phone}}
                    </td>
                    <td class="text-center">
                      <ul style="list-style:none">
                        <li v-for="(address,key) in list.address" :key="key">{{address.name}}</li>
                      </ul>
                    </td>
                    <td class="text-center">
                      <span v-if="list.migration_status==1" class="badge badge-success">Migrated</span>

                      <!-- <span v-else class="badge badge-danger">Danger</span> -->
                    </td>
                    <td class="text-center">{{list.migration_date}}</td>
                    <td class="text-center">
                      <button
                        title="edit migration"
                        style="padding: 2px 7px; font-size: 13px;"
                        @click="openMigrateModalSingle(Object.assign({},list),key)"
                        type="button"
                        class="btn btn-primary"
                      >
                        <i class="fas fa-user-edit"></i>
                      </button>
                      <button
                        style="padding: 2px 7px; font-size: 13px;"
                        @click="openModal(Object.assign({},list),key)"
                        type="button"
                        class="btn btn-primary"
                      >
                        <i class="fa fa-pencil-square-o"></i>
                      </button>
                      <button
                        style="padding: 2px 7px; font-size: 13px;"
                        @click="openModal()"
                        type="button"
                        class="btn btn-info"
                      >
                        <i class="fa fa-eye"></i>
                      </button>
                      <button
                        style="padding: 2px 7px; font-size: 13px;"
                        @click="deleteUser(key,list.id)"
                        type="button"
                        class="btn btn-warning"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <pagination :data="this.lists" @pagination-change-page="get" :limit="5"></pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
    <create v-show="modalOpen" ref="user_create"></create>
    <status ref="user_status" :status_data="status_data"></status>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from 'vuex'
import create from '~/components/dashboard/user/create'
import status from '~/components/dashboard/user/status'
import pagination from 'laravel-vue-pagination'
import Multiselect from 'vue-multiselect'
export default {
  name: 'User',
  middleware: 'auth',
  layout: 'dashboard',
  components: { create, status, pagination,Multiselect },
  data() {
    return {
      modalOpen: false,
      districts:[],
      subdistricts:[],
      divisions:[],
      division:{id:''},
      district:{id:''},
      subdistrict:{id:''},
      usera: [],
      activate_status: false,
      status_data: {
        migration_date: '',
        migration_status: '',
        status: '',
        type: '',
        usera: []
      },
      d_status_data: {
        migration_date: '',
        migration_status: '',
        status: '',
        type: '',
        usera: []
      },
      search: {
        migrate: '',
        migrate_date: '',
        division_id: '',
        district_id: '',
        upozila_id: '',
        search: '',
        type: 6,
        limit: 10,
        page: ''
      }
    }
  },
  computed: mapGetters({
    lists: 'admin/user/user/lists'
  }),
  mounted() {
    this.getDivision()
    this.get()
    this.get_a()
    this.get_r()
  },
  methods: {
    alluser() {
      if (this.activate_status) {
        this.usera = []
      } else {
        this.usera = []
        let th = this
        this.lists.data.forEach(function(user) {
          th.usera.push(user.id)
        })
      }
    },
    openMigrateModalSingle(data, key) {
      this.usera = []
      this.usera.push(data.id)
      this.status_data.migration_date = data.migration_date
      this.status_data.migration_status = data.migration_status
      this.$refs.user_status.openModal()
    },
    async get_r() {
      try {
        await this.$store.dispatch('admin/user/role/get')
      } catch (e) {}
    },
    async get(page = 1) {
      this.search.page = page
      this.search.division_id = this.division.id;
      this.search.district_id = this.district.id;
      this.search.subdistrict_id = this.subdistrict.id;
      console.log(this.search)
      try {
        await this.$store.dispatch('admin/user/user/get', this.search)
      } catch (e) {}
    },

    async get_a() {
      try {
        await this.$store.dispatch('admin/Basic/get_a')
      } catch (e) {}
    },
    openMigrateModal() {
      this.status_data.migration_date = ''
      this.status_data.migration_status = ''
      this.$refs.user_status.openModal()
    },
    openModal(data = '', key = '') {
      this.$refs.user_create.openModal(data, key)
    },
    async deleteUser(key, id) {
      try {
        await this.$store.dispatch('admin/user/user/delete', { key, id })
      } catch (e) {}
    },
    async getDivision() {
      this.$axios
        .get('api/get-division')
        .then(response => {
          this.divisions = response.data
        })
        .catch(error => {})
    },
    async getDistrictByID2() {
      var self = this;
      this.$axios
        .get('api/get-district/' + this.division.id)
        .then(response => {
          self.districts = response.data
        })
        .catch(error => {})
    },
    async getSubdistrict2() {
      this.$axios
        .get('api/get-subdistrict/' + this.district.id)
        .then(response => {
          this.subdistricts = response.data
        })
        .catch(error => {})
    }
  }
}
</script>
