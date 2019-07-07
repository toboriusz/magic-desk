<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title v-if="editMode" class="headline">Edit product</v-card-title>
      <v-card-title v-else class="headline">Add new product</v-card-title>
      <v-card-text class="p-rel">
        <v-form @submit.prevent="validate" ref="form">
          <v-text-field
            name="brand"
            label="Brand"
            type="text"
            v-model="form.brand"
            autofocus
            data-vv-name="brand"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('brand')">
          </v-text-field>
          <v-text-field
            name="model"
            label="Model"
            type="text"
            v-model="form.model"
            autofocus
            data-vv-name="model"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('model')">
          </v-text-field>
          <v-text-field
            name="part_no"
            label="Part number"
            type="text"
            v-model="form.part_no"
            autofocus
            data-vv-name="part_no"
            v-validate="'alpha_dash'"
            :error-messages="$validator.errors.collect('part_no')">
          </v-text-field>
          <v-textarea
            name="description"
            label="Description"
            v-model="form.description"
            rows="1"
            auto-grow
            data-vv-name="description"
            :error-messages="$validator.errors.collect('description')">
          </v-textarea>
        </v-form>
        <md-loading :loading="loadingData"></md-loading>  
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
</template>

<script>
  import { mapGetters } from 'vuex'
  import MdLoading from 'Components/MdLoading'

  export default {

    name: 'modal-product-form',

    props: {
      assetTypeId: null
    },

    data () {
      return {
        productId: null,
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        form: {
          asset_type_id: this.assetTypeId,
          brand: '',
          model: '',
          part_no: '',
          description: ''
        }
      }
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
        this.$store.dispatch('products/add', this.form).then( (res) => {
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
        this.$store.dispatch('products/update', {
          id: this.productId,
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
      }
    },
    mounted () {
      this.$on('open', (id = null) => {
        this.productId = id
        
        if(id) {
          this.editMode = true
          this.productId = id
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('products/fetch', id).then( (res) => {
            this.form.brand = res.data.data.brand
            this.form.model = res.data.data.model
            this.form.part_no = res.data.data.part_no
            this.form.description = res.data.data.description
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
      MdLoading
    }

  }
</script>
