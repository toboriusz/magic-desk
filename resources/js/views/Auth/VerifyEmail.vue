<template>       
  <div class="layout column align-center">
    <h3>Email verification</h3>
    <response-loader class="my-3" v-model="state"></response-loader>
    <p :class="messageColor" class="font-weight-bold">&nbsp;{{ message }}&nbsp;</p>
    <v-btn 
      class="p-verify__login"
      :class="{ 'p-verify__login--shown' : state !== 'loading' }" 
      color="primary"
      @click="login">
      Login
    </v-btn>
  </div>
</template>

<script>
  import ResponseLoader from 'Components/ResponseLoader'

  export default {

    name: 'ViewVerifyEmail',

    data () {
    	return {
        state: 'loading',
        message: null,
        userEmail: null
		  }
  	},
  	
  	computed: {
  		logoSrc () {
  			return require('Assets/logo-dark.svg')
  		},
      messageColor () {
        return this.state + '--text'
      }
  	},

  	methods: {
  		login () {
        if(this.userEmail) {
          this.$router.push({ 
            name: 'Login', 
            query: { 
              email: this.userEmail 
            } 
          });  
        } else {
          this.$router.push({ name: 'Login' })
        }
  		}
  	},

    mounted () {
      setTimeout(() => {
        this.$store.dispatch('auth/verifyEmail', {
          token: this.$route.params.token
        }).then( ({data}) => {
          this.state = 'success'
          this.message = data.message
          this.userEmail = data.data.email
        }).catch(({response}) => {
          this.state = 'error'
          this.message = response.data.message
        })  
      }, 1000)
    },

    components: {
      ResponseLoader
    }
  }
</script>

<style lang="sass">
  @import '~Style/_utils.sass'
  .p-verify
    
    &:before
      background-color: $primary
      height: 50%
      width: 100%
      position: absolute
      top: 0
      left: 0
      content: ""
      z-index: 0

    &__login
      opacity: 0
      pointer-events: none
      transition: opacity .4s ease-in-out

      &--shown
        opacity: 1
        pointer-events: auto



</style>
