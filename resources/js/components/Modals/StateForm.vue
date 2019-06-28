<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title v-if="editMode" class="headline">Edit state</v-card-title>
      <v-card-title v-else class="headline">Add new state</v-card-title>
      <v-card-text class="p-rel">
        <v-form @submit.prevent="validate" ref="form">
          <v-text-field
            name="name"
            label="Name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="name"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
          <v-textarea
            name="description"
            label="Description"
            v-model="form.description"
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

    name: 'modal-state-form',

    props: {
      assetTypeId: null
    },

    data () {
      return {
        stateId: null,
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        form: {
          asset_type_id: this.assetTypeId,
          name: '',
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
        this.$store.dispatch('states/add', this.form).then( (res) => {
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
        this.$store.dispatch('states/update', {
          id: this.stateId,
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
        this.stateId = id
        
        if(id) {
          this.editMode = true
          this.stateId = id
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('states/fetch', id).then( (res) => {
            this.form.name = res.data.data.name
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
