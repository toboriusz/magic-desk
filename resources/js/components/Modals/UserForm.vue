<template>
  <v-dialog
    v-model="dialog"
    persistent
    no-click-animation
    max-width="550">
    <v-card>
      <v-card-title v-if="editMode" class="headline">Edit user</v-card-title>
      <v-card-title v-else class="headline">Add new user</v-card-title>
      <v-card-text class="p-rel">
        <v-form @submit.prevent="validate" ref="form">
          <p class="title pt-3">General</p>
          <v-text-field
            name="first_name"
            label="First name"
            type="text"
            v-model="form.first_name"
            autofocus
            data-vv-name="first_name"
            v-validate="'required'"
            @change="error = ''"
            :error-messages="$validator.errors.collect('first_name')">
          </v-text-field>
          <v-text-field
            name="last_name"
            label="Last name"
            type="text"
            v-model="form.last_name"
            data-vv-name="last_name"
            @change="error = ''"
            :error-messages="$validator.errors.collect('last_name')">
          </v-text-field>
          <v-text-field
            name="job_title"
            label="Job title"
            type="text"
            v-model="form.job_title"
            data-vv-name="job_title"
            @change="error = ''"
            :error-messages="$validator.errors.collect('job_title')">
          </v-text-field>
          <v-select
            name="site_id"
            label="Service"
            v-model="form.site_id"
            clearable
            item-text="name"
            item-value="id"
            :items="sitesList"
            data-vv-name="site_id"
            @change="error = ''"
            :error-messages="$validator.errors.collect('site_id')">
          </v-select>
          <p class="title pt-3">Contact details</p>
          <v-text-field
            name="email"
            label="Email"
            type="email"
            v-model="form.email"
            data-vv-name="email"
            @change="error = ''"
            :error-messages="$validator.errors.collect('email')">
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
            name="mobile"
            label="Mobile phone"
            type="text"
            v-model="form.mobile"
            data-vv-name="mobile"
            @change="error = ''"
            :error-messages="$validator.errors.collect('mobile')">
          </v-text-field>
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

    name: 'modal-site-form',

    data () {
      return {
        userId: null,
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
          site_id: null,
          description: ''
        }
      }
    },

    computed: {
      ...mapGetters('sites', {
        sitesList: 'basicList'
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
        this.$store.dispatch('users/add', this.form).then( (res) => {
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
        this.$store.dispatch('users/update', {
          id: this.userId,
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
        this.userId = id || null
        this.loadingData = true
        this.$store.dispatch('sites/fetchBasicList').finally(() => {
          this.loadingData = false
        })
        
        if(this.userId) {
          this.editMode = true
          this.loadingData = true
          this.dialog = true
          this.$store.dispatch('users/fetch', this.userId).then( (res) => {
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
