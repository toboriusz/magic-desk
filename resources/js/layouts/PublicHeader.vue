<template>
	<router-link to="/" class="layout column align-center l-public-h">
		<img :src="logoSrc" alt="Magic desk" class="l-public-h__logo mt-2 mb-4">
	</router-link>
</template>

<script>
	export default {
		name: 'PublicHeader',

		computed: {
  		logoSrc () {
  			return require('Assets/logo-dark.svg')
  		}
  	}
	}
</script>

<style lang="sass">
  .l-public-h
    text-decoration: none
    
    &__logo
      max-width: 220px
			
</style>