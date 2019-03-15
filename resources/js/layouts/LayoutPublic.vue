<template>
	<v-app>
		<v-content>
			<v-container fluid fill-height class="l-public">
				<div class="l-public__bg"></div>
				<v-layout align-center justify-center>
					<v-flex class="l-public__content">
						<v-card class="elevation-1 pa-3">
							<v-card-text>
								<the-public-header></the-public-header>
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
	import ThePublicHeader from 'Layouts/ThePublicHeader'

	export default {
		
		name: 'layout-public',

		components: {
			ThePublicHeader
		}

	}
</script>

<style lang="sass">
	@import '~Style/_utils.sass'

	.l-public
			
		&__content
			max-width: 450px

		@keyframes bg-move 
			100%
				transform: translate3d(0, 0, 0)

		&__bg
			position: fixed
			top: 0
			left: 0
			width: 100%
			height: 100%
			overflow: hidden
			opacity: 0.1

			&:before
				content: ''
				position: absolute
				top: 0
				left: 0
				width: 100%
				height: calc(100% + 129px)
				filter: blur(1px)
				animation: bg-move 20s linear infinite
				transform: translate3d(0, -129px, 0)
				background-size: 129px 129px
				background-position: 0 0
				background-repeat: repeat
				background-image: url('~Assets/pattern.svg')

</style>