<template>
	<v-container>
	  <md-header>
		  <h2>Settings</h2>
		  <span>About</span>
		</md-header>
		<v-layout column align-center justify-center class="text-xs-center" >	
			<h1 class="grey--text lighten-3 mb-5">Magic Desk</h1>
			<p style="max-width: 350px">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco.</p>
			<p><strong>Version:</strong> 0.0.1</p>
			<p><strong>Author:</strong> <a href="https://toborek.dev">Maciej Toborek</a></p>
		</v-layout>
	</v-container>
</template>

<script>
	import MdHeader from 'Components/MdHeader'
	
  export default {

    name: 'ViewSettingsAbout',

    methods: {

    },

    components: {
    	MdHeader
    }

  }
</script>