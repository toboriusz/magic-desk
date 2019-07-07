<template>
	<v-fade-transition>
		<v-layout 
			v-if="loading"
			align-center 
			justify-center 
			class="md-loading white" >
		  <v-progress-circular indeterminate></v-progress-circular>
		</v-layout>
	</v-fade-transition>
</template>

<script>
	export default {
		name: 'md-loading',

		props: {
			loading: Boolean,
			color: {
				type: String,
				default: 'white'
			}
		}
	}
</script>

<style lang="sass">
	.md-loading
		position: absolute
		top: 0
		left: 0
		z-index: 1
		width: 100%
		height: 100%


</style>