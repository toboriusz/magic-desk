<template>
  <v-form @submit.prevent="validate">
    <p class="text-xs-center font-weight-bold red--text">{{ error }}</p>
    <v-text-field
      append-icon="person"
      name="email"
      label="Login"
      type="email"
      v-model="email"
      :autofocus="!$route.query.email"
      data-vv-name="email"
      v-validate="'required'"
      @change="error = ''"
      :error-messages="$validator.errors.collect('email')">
    </v-text-field>

    <v-text-field
      append-icon="lock"
      name="password"
      label="Password"
      type="password"
      v-model="password"
      :autofocus="!!$route.query.email"
      v-validate="'required'"
      @change="error = ''"
      :error-messages="$validator.errors.collect('password')">
    </v-text-field>

    <v-checkbox
      label="Remember me"
      v-model="remember_me"
      color="primary">
    </v-checkbox>

    <div class="layout-row">
      <v-btn type="submit" block color="primary" :loading="loading">Login</v-btn>
      <v-btn @click="resetPassword" class="mt-3" block flat>Forgot password</v-btn>
    </div>
  </v-form>
</template>

<script>
  import Utils from 'Utils'
  export default {

    name: 'ViewLogin',

    data () {
    	return {
		    loading: false,
	      email: this.$route.query.email || '',
	      password: '',
	      remember_me: false,
        error: ''
		  }
  	},
  	
  	computed: {
  		logoSrc () {
  			return require('Assets/logo-dark.svg')
  		}
  	},

  	methods: {
      validate () {
        this.$validator.validateAll().then(( isValid ) => {
          if(isValid) {
            this.login()
          }
        })
      },
  		login () {
  			this.loading = true
        this.error = ''
        this.$auth.login({
          data: {
            email: this.email,
            password: this.password,
            remember_me: this.remember_me  
          },
          rememberMe: this.remember_me,
          error: (e) => {
            this.showValidationErrors(e)
            if(e.response.status === 401) {
              this.error = e.response.data.message
            }
            this.loading = false
          }
        })
  		},
      resetPassword () {
        let query = {}
        if(this.email.indexOf('@') !== -1)
          query.email = this.email

        this.$router.push({ name: 'SendResetEmail', query: query})
      }
  	}
  }
</script>
