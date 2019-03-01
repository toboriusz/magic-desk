<template>
	<v-app>
	  <v-content>
	  	<v-container fluid fill-height class="l-public">
		    <v-layout align-center justify-center>
		      <v-flex xs12 sm8 md4 lg3>
		        <v-card class="elevation-1 pa-3">
		          <v-card-text>
								<public-header></public-header>
	    					<slot></slot>
	    				</v-card-text>
	        	</v-card>
		      </v-flex>
		    </v-layout>
		  </v-container>
			<!-- footer -->
		</v-content>
	</v-app>
</template>

<script>
	import PublicHeader from 'Layouts/PublicHeader'

  export default {
    
    name: 'LayoutPublic',

    components: {
    	PublicHeader
    }

  }
</script>

<style lang="sass">
  @import '~Style/_utils.sass'
  
  .l-public
    &:before
      background-color: $primary
      height: 50%
      width: 100%
      position: absolute
      top: 0
      left: 0
      content: ""
      z-index: 0

</style>