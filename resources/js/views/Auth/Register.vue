<template>
  <div class="p-register">
    <div class="p-register__success hidden" :class="{ 'shown': success }">
      <md-response-loader class="mb-5" v-model="loaderState"></md-response-loader>
      <p class="text-xs-center green--text font-weight-bold">{{ success }}</p>
    </div>

    <v-form @submit.prevent="validate" class="p-register__form" :class="{ 'hidden': success }">
      <v-text-field
        label="First name"
        data-vv-as="First name"
        type="text"
        name="first_name"
        v-model="form.first_name"
        v-validate="'required|max:30'"
        :error-messages="$validator.errors.collect('first_name')"
        autofocus>
      </v-text-field>

      <v-text-field
        label="Last name"
        data-vv-as="Last name"
        type="text"
        name="last_name"
        v-model="form.last_name"
        v-validate="'required|max:30'"
        :error-messages="$validator.errors.collect('last_name')">
      </v-text-field>

      <v-text-field
        label="Email"
        data-vv-as="Email"
        type="email"
        name="email"
        v-model="form.email"
        v-validate="'required|email'"
        :error-messages="$validator.errors.collect('email')">
      </v-text-field>

      <v-text-field
        ref="password"
        label="Password"
        data-vv-as="Password"
        type="password"
        name="password"
        v-model="form.password"
        v-validate="'required|min:6'"
        :error-messages="$validator.errors.collect('password')">
      </v-text-field>

      <v-text-field
        label="Confirm password"
        data-vv-as="Password"
        type="password"
        name="password_confirmation"
        v-model="form.password_confirmation"
        v-validate="'confirmed:password'"
        :error-messages="$validator.errors.collect('password_confirmation')">
      </v-text-field>

      <!-- <v-checkbox
        label="I agree to the Terms of Serice"
        v-model="form.agreed"
        name="agreed"
        v-validate="'required'"
        :error-messages="$validator.errors.collect('agreed')"
        color="primary">
      </v-checkbox>
      <p><a href='/docs/terms.pdf'>Terms of Service</a></p> -->

      <p class="text-xs-center font-weight-bold red--text">{{ error }}</p>

      <div class="layout-row">
        <v-btn type="submit" block color="primary" :loading="loading">Create account</v-btn>
        <v-btn :to="{ name: 'Login' }" class="mt-3 mb-0" block flat>Already have an account</v-btn>
      </div>
    </v-form>
  </div>
</template>

<script>
  import Utils from 'Utils'
  import MdResponseLoader from 'Components/MdResponseLoader'
  export default {

    name: 'ViewRegister',

    data () {
    	return {
        loading: false,
        error: '',
        loaderState: 'idle',
        success: '',
        form: {
          first_name: '',
          last_name: '',
          email: '',
          password: '',
          password_confirmation: '',
	        agreed: false,
        }
		  }
  	},

  	methods: {
      validate () {
        this.$validator.validateAll().then(( isValid ) => {
          //Bug fix
          if(this.form.password_confirmation === '') {
            this.$validator.errors.add({
              field: 'password_confirmation',
              msg: 'The password confirmation is required'
            })
            return false
          }

          if(isValid) {
            this.register()
          }
        })
      },
  		register () {
  			this.loading = true
        this.error = ''
        this.$store.dispatch('auth/register', this.form).then( (res) => {
          this.loading = false
          this.success = res.data.message

          setTimeout(() => {
            this.loaderState = 'success'
          }, 700)

        }).catch( (e) => {
          this.showValidationErrors(e)
          this.loading = false
          this.error = e.response.data.message
        })
  		}
    },
    
    components: {
      MdResponseLoader
    }
  }
</script>

<style lang="sass">
  .p-register
    position: relative

    &__form,
    &__success
      transition: opacity .5s ease-in-out

      &.hidden
        opacity: 0
        pointer-events: none
        
      &.shown
        opacity: 1
        pointer-events: auto

    &__success
      position: absolute
      top: 0
      left: 0
      width: 100%
      height: 100%
      display: flex
      flex-direction: column
      align-items: center
      justify-content: center
      opacity: 0
      text-align: center

</style>

