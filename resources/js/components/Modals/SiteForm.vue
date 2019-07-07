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
            label="Site name"
            type="text"
            v-model="form.name"
            autofocus
            data-vv-name="name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('name')">
          </v-text-field>
          <v-text-field
            name="phone"
            label="Phone"
            type="text"
            v-model="form.phone"
            data-vv-name="phone"
            @change="error = ''"
            :error-messages="$validator.errors.collect('phone')">
          </v-text-field>
          <v-text-field
            name="address1"
            label="Address"
            type="text"
            v-model="form.address1"
            data-vv-name="address1"
            @change="error = ''"
            :error-messages="$validator.errors.collect('address1')">
          </v-text-field>
          <v-text-field
            name="address2"
            label="Address (line 2)"
            type="text"
            v-model="form.address2"
            data-vv-name="address2"
            @change="error = ''"
            :error-messages="$validator.errors.collect('address2')">
          </v-text-field>
          <v-text-field
            name="city"
            label="City"
            type="text"
            v-model="form.city"
            data-vv-name="city"
            @change="error = ''"
            :error-messages="$validator.errors.collect('city')">
          </v-text-field>
          <v-text-field
            name="country"
            label="Country"
            type="text"
            v-model="form.country"
            data-vv-name="country"
            @change="error = ''"
            :error-messages="$validator.errors.collect('country')">
          </v-text-field>
          <v-text-field
            name="postcode"
            label="Postcode"
            type="text"
            v-model="form.postcode"
            data-vv-name="postcode"
            @change="error = ''"
            :error-messages="$validator.errors.collect('postcode')">
          </v-text-field>
          <v-select
              name="parent_id"
              label="Project"
              v-model="form.parent_id"
              item-text="name"
              item-value="id"
              :items="filteredProjects"
              @change="error = ''"
              data-vv-name="parent_id"
              :error-messages="$validator.errors.collect('parent_id')">
          </v-select>
          <v-textarea
            name="description"
            label="Description"
            v-model="form.description"
            data-vv-name="description"
            rows="1"
            auto-grow
            @change="error = ''"
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

    name: 'modal-site-form',

    data () {
      return {
        siteId: null,
        editMode: false,
        loading: false,
        loadingData: false,
        dialog: false,
        form: {
          name: '',
          phone: '',
          address1: '',
          address2: '',
          country: '',
          postcode: '',
          parent_id: null,
          description: ''
        }
      }
    },

    computed: {
      ...mapGetters('sites', {
        projects: 'projects'
      }),
      filteredProjects() {
        var projects = this.projects.filter((site) => {
          return site.id !== this.siteId 
        })

        projects.unshift({
          id: null,
          name: 'This is a project'
        })

        return projects
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
        this.$store.dispatch('sites/add', this.form).then( (res) => {
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
        this.$store.dispatch('sites/update', {
          id: this.siteId,
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
        this.siteId = id
        this.$store.dispatch('sites/fetchBasicList')
        
        if(id) {
          this.editMode = true
          this.siteId = id
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('sites/fetch', id).then( (res) => {
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
