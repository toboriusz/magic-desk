<template>
	<router-link to="/" class="layout column align-center l-public-h">
		<img :src="logoSrc" alt="Logo name" width="80" height="80" class="l-public-h__logo">
		<h1 class="my-4 font-weight-light text-xs-center primary--text l-public-h">Application name</h1>
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
      animation: rotate 30s linear infinite
      transform: rotate(0deg)
</style>