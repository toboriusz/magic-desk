<template>
  <div>
    <v-dialog
      v-model="dialog"
      persistent
      no-click-animation
      max-width="550">
      <v-card>
        <v-card-title v-if="editMode" class="headline">Edit {{ assetType.name || 'asset' }}</v-card-title>
        <v-card-title v-else class="headline">Add new {{ assetType.name || 'asset' }}</v-card-title>
        <v-card-text class="p-rel">
          <v-form @submit.prevent="validate" ref="form">
            <v-text-field
              name="name"
              label="Name"
              type="text"
              v-model="form.name"
              ref="firstField"
              data-vv-name="name"
              v-validate="'required'"
              @change="error = ''"
              :error-messages="$validator.errors.collect('name')">
            </v-text-field>
            <v-select
              name="product_id"
              label="Product"
              v-model="form.product_id"
              :items="assetType.products"
              cache-items
              item-value="id"
              data-vv-name="product_id"
              no-data-text="No products"
              v-validate="'required'"
              :error-messages="$validator.errors.collect('product_id')">
              <template v-slot:item="data">
                <span class="pr-1 font-weight-medium">{{ data.item.brand }}</span> {{ data.item.model }}
              </template>
              <template v-slot:selection="data">
                <span class="pr-1 font-weight-medium">{{ data.item.brand }}</span> {{ data.item.model }}
              </template>
              <template v-slot:append-outer>
                <v-icon @click="$refs.modalProductForm.$emit('open')" class="primary--text">add</v-icon>
              </template>
            </v-select>
            <v-text-field
              name="serial_no"
              label="Serial number"
              type="text"
              v-model="form.serial_no"
              data-vv-name="serial_no"
              v-validate="'required'"
              @change="error = ''"
              :error-messages="$validator.errors.collect('serial_no')">
            </v-text-field>
            <v-text-field
              name="barcode"
              label="Barcode"
              type="text"
              v-model="form.barcode"
              data-vv-name="barcode"
              v-validate="'required'"
              @change="error = ''"
              :error-messages="$validator.errors.collect('barcode')">
            </v-text-field>
            <v-select
              name="state_id"
              label="State"
              v-model="form.state_id"
              :items="assetType.states"
              item-text="name"
              item-value="id"
              data-vv-name="state_id"
              @change="error = ''"
              no-data-text="No setup states"
              :error-messages="$validator.errors.collect('state_id')">
            </v-select>
            <v-textarea
              max-height="10"
              name="description"
              label="Description"
              v-model="form.description"
              data-vv-name="description"
              rows="1"
              auto-grow
              @change="error = ''"
              :error-messages="$validator.errors.collect('description')">
            </v-textarea>
            <p class="title pt-3">Assigned to</p>
            <v-autocomplete
              name="employee_id"
              label="Employee"
              v-model="form.employee_id"
              :items="employees"
              cache-items
              data-vv-name="employee_id"
              item-text="name"
              item-value="id"
              clearable
              no-data-text="No employees"
              :error-messages="$validator.errors.collect('employee_id')">
              <template v-slot:append-outer>
                <v-icon @click="$refs.modalEmployeeForm.$emit('open')" class="primary--text">add</v-icon>
              </template>
            </v-autocomplete>
            <v-autocomplete
              name="site_id"
              label="Service"
              v-model="form.site_id"
              :items="sites"
              cache-items
              data-vv-name="site_id"
              item-text="name"
              item-value="id"
              clearable
              no-data-text="No services"
              :error-messages="$validator.errors.collect('site_id')">
              <template v-slot:append-outer>
                <v-icon @click="$refs.modalSiteForm.$emit('open')" class="primary--text">add</v-icon>
              </template>
            </v-autocomplete>
            <md-loading :loading="loadingData"></md-loading>  
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="grey"
            flat
            @click="dialog = false">
            Cancel
          </v-btn>
          <v-btn
            color="green"
            flat
            :loading="loading"
            :disabled="loadingData"
            @click="validate">
            {{ editMode ? 'Update' : 'Create' }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <modal-product-form
        ref="modalProductForm"
        :asset-type-id="assetType.id"
        @success="afterAddingProduct">
    </modal-product-form>
    <modal-employee-form
        ref="modalEmployeeForm"
        @success="afterAddingEmployee">
    </modal-employee-form>
    <modal-site-form
        ref="modalSiteForm"
        @success="afterAddingSite">
    </modal-site-form>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import MdLoading from 'Components/MdLoading'
  import ModalProductForm from 'Components/Modals/ProductForm'
  import ModalEmployeeForm from 'Components/Modals/EmployeeForm'
  import ModalSiteForm from 'Components/Modals/SiteForm'

  export default {

    name: 'modal-asset-type-form',

    data () {
      return {
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        assetId: null,
        assetTypeId: null,
        form: {
          asset_type_id: null,
          name: '',
          product_id: null,
          serial_no: '',
          barcode: '',
          state_id: null,
          user_id: null,
          site_id: null,
          description: ''
        }
      }
    },

    computed: {
        ...mapGetters('icons', {
            iconList: 'list'
        }),
        ...mapGetters('assetTypes', {
            assetType: 'assetType'
        }),
        ...mapGetters('sites', {
            sites: 'basicList'
        }),
        ...mapGetters('employees', {
            employees: 'list'
        })
    },

    methods: {
      validate() {
        this.$validator.validateAll().then(( isValid ) => {
          if(isValid) {
            if(this.editMode) {
              this.submitUpdate()
            } else {
              this.submitNew()
            }
          }
        })
      },
      submitNew() {
        this.loading = true
        this.form.asset_type_id = this.assetType.id
        this.$store.dispatch('assets/add', this.form).then( (res) => {
          this.$emit('success')
          this.dialog = false
        }).catch( (e) => {
          //show alert error
          this.showValidationErrors(e)
        }).finally( () => {
          this.loading = false
        })
      },
      submitUpdate() {
        this.loading = true
        this.form.asset_type_id = this.assetType.id
        this.$store.dispatch('assets/update', {
          id: this.assetId,
          data: this.form
        }).then( (res) => {
          this.$emit('success')
          this.dialog = false
        }).catch( (e) => {
          //show alert error
          this.showValidationErrors(e)
        }).finally( () => {
          this.loading = false
        })
      },
      afterAddingProduct (product) {
        this.$store.dispatch('assetTypes/fetch', this.assetType.id).then( () => {
          this.$nextTick(() => {
            this.form.product_id = product.id
          })  
        })
      },
      afterAddingEmployee (employee) {
        this.$store.dispatch('employees/fetchBasicList').finally(() => {
          this.$nextTick(() => {
            this.form.employee_id = employee.id
          })  
        })
      },
      afterAddingSite (site) {
        this.$store.dispatch('sites/fetchList', this.assetType.id).then( () => {
          this.$nextTick(() => {
            this.form.site_id = site.id
          })  
        })
      }
    },

    mounted () {
      this.$on('open', (id) => {
        this.assetId = id || null

        this.loadingData = true

        Promise.all([
          this.$store.dispatch('sites/fetchBasicList'),
          this.$store.dispatch('employees/fetchList')
        ]).finally(() => {
          this.loadingData = false
        })
        if(this.assetId) {
          this.editMode = true
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('assets/fetch', this.assetId).then( (res) => {
            this.form = res.data.data
          }).finally(() => {
              this.loadingData = false
          })
        } else {
          this.editMode = false
          this.$refs.form.reset()
          this.$nextTick(() => {
            this.$validator.reset();
            this.dialog = true
          })
        }
      })
    },

    beforeDestroy () {
      this.$off('open')
    },

    components: {
      MdLoading,
      ModalProductForm,
      ModalEmployeeForm,
      ModalSiteForm
    }

  }
</script>
