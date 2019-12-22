<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title v-if="editMode" class="headline">Edit fields group</v-card-title>
      <v-card-title v-else class="headline">Add new fields group</v-card-title>
      <v-card-text class="p-rel">
        <v-form @submit.prevent="validate" ref="form">
          <v-text-field
            name="name"
            label="Group name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="name"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
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
          {{ editMode ? 'Update' : 'Add' }}
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  import { mapGetters } from 'vuex'
  import MdLoading from 'Components/MdLoading'

  export default {

    name: 'modal-custom-field-group-form',

    props: {
      assetTypeId: null
    },

    data () {
      return {
        customFieldGroupId: null,
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        form: {
          name: ''
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
        this.form.asset_type_id = this.assetTypeId
        this.$store.dispatch('customFields/addGroup', this.form).then( (res) => {
          this.$emit('success', res.data.data)
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
        this.$store.dispatch('customFields/updateGroup', {
          id: this.customFieldGroupId,
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
      this.$on('open', (id) => {
        this.customFieldGroupId = id || null
        
        if(this.customFieldGroupId) {
          this.editMode = true
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('customFields/fetchGroup', this.customFieldGroupId).then( (res) => {
            this.form.name = res.data.data.name
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
