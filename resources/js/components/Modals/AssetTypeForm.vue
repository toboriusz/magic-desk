<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title v-if="editMode" class="headline">Edit asset type</v-card-title>
      <v-card-title v-else class="headline">Add new asset type</v-card-title>
      <v-card-text class="p-rel">
        <v-form @submit.prevent="validate" ref="form">
          <v-text-field
            name="name"
            label="Name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="Name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
          <v-autocomplete
            name="icon"
            label="Icon"
            v-model="form.icon"
            :items="iconList"
            cache-items
            data-vv-name="icon"
            v-validate="'required'"
            :error-messages="$validator.errors.collect('icon')">
            <template v-slot:selection="data">
              <v-icon class="pr-3">{{ data.item.value }}</v-icon> {{ data.item.text }}
            </template>
            <template v-slot:item="data">
              <v-icon class="pr-3">{{ data.item.value }}</v-icon> {{ data.item.text }}
            </template>
          </v-autocomplete>
          <v-textarea
            name="description"
            label="Description"
            v-model="form.description"
            data-vv-name="Description"
            rows="1"
            auto-grow
            @change="error = ''"
            :error-messages="$validator.errors.collect('description')">
          </v-textarea>
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
</template>

<script>
  import { mapGetters } from 'vuex'
  import MdLoading from 'Components/MdLoading'

  export default {

    name: 'modal-asset-type-form',

    data () {
      return {
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        assetTypeId: null,
        form: {
          name: '',
          icon: '',
          description: ''
        }
      }
    },

    computed: {
        ...mapGetters('icons', {
            iconList: 'list'
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
        this.$store.dispatch('assetTypes/add', this.form).then( (res) => {
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
        this.$store.dispatch('assetTypes/update', {
          id: this.assetTypeId,
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
        this.assetTypeId = id || null
        
        if(this.assetTypeId) {
          this.editMode = true
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('assetTypes/fetch', this.assetTypeId).then( (res) => {
            this.form = this.noReact(res.data.data)
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
