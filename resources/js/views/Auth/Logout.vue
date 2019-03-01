<template>
  <div class="layout column align-center p-logout">
    <h3>Logout</h3>
    <response-loader class="my-3" v-model="state"></response-loader>
    <p :class="messageColor" class="font-weight-bold">&nbsp;{{ message }}&nbsp;</p>
    <v-btn 
      class="p-logout__login"
      :class="{ 'p-logout__login--shown' : state !== 'loading' }" 
      color="primary"
      :to="{ name: 'Login' }">
      Go to login page
    </v-btn>
  </div>
</template>

<script>
	import ResponseLoader from 'Components/ResponseLoader'

  export default {

    name: 'ViewLogout',

    data () {
    	return {
    		state: 'loading',
        message: null
    	}
    },


    computed: {
      messageColor () {
        const colors = {
          'locked' : 'success--text',
          'error' : 'error--text'
        }
        return colors[this.state]
      }
    },

    methods : {
    	logout () {
    		this.$auth.logout({
          makeRequest: true,
          redirect: null,
    			success: (res) => {
            this.message = res.data.message
    				this.state = 'locked'
    			},
    			error: (e) => {
            this.message = e.response.data.message
    				this.state = 'error'
            this.$auth.logout({ 
              makeRequest: false,
              redirect: null
            })
    			}
    		})
    	}
    },

    mounted () {
    	setTimeout(this.logout, 700)
    },

    components: {
    	ResponseLoader
    }

  }
</script>

<style lang="sass">
  .p-logout
    &__login
      opacity: 0
      pointer-events: none
      transition: opacity .5s ease-in-out

      &--shown
        opacity: 1
        pointer-events: auto
</style>