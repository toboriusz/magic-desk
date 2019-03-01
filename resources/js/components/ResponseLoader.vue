<template>
	<div class="response-loader" :class="compClass"></div>
</template>

<script>
	export default {
		name: 'ResponseLoader',

		props: {
			value: {
				type: String,
				values: ['idle', 'loading', 'error', 'success', 'locked'],
				default: 'idle'
			}
		},

		computed: {
			compClass () {
				return 'response-loader--' + this.value
			}
		}
	}
</script>

<style lang="sass">
	@import '~Style/_utils.sass'

	.response-loader
		border: 5px solid rgba(0, 0, 0, 0.2)
		transition: border-color 0.25s ease-in
		position: relative
		display: inline-block
		vertical-align: top
		border-radius: 50%
		width: 80px
		height: 80px

		&:before,
		&:after
			content: ''
			opacity: 0
			position: absolute
			width: 5px
			height: 0px

		&--loading
			border-left-color: $primary
			animation: rotate 1.2s infinite linear

		&--error
			border-color: $red

			&:before,
			&:after
				top: 50%
				left: 50%
				opacity: 1
				background-color: $red
				height: 35px
				transform-origin: center
				transition: height .3s .20s cubic-bezier(.76,0,.6,1.76)

			&:before
				transform: translate(-50%, -50%) rotate(45deg)

			&:after
				transform: translate(-50%, -50%) rotate(-45deg)

		&--success
			border-color: $green

			&:before,
			&:after
				opacity: 1
				background-color: $green
				transform-origin: top left
				transition: height .1s .20s linear

			&:before
				top: 38px
				left: 12px
				transform: rotate(-45deg)
				height: 25px


			&:after
				top: 53px
				left: 32px
				transform: rotate(225deg)
				transition-delay: .35s
				height: 35px


		&--locked
			&:before,
			&:after
				transition: none
				opacity: 1
				

			&:before
				top: 30px
				left: 20px
				width: 30px
				height: 25px
				border-radius: 3px
				background-color: $body-bg
				border: 11px solid #bbb
				z-index: 2

			&:after
				top: 14px
				left: 20px
				width: 30px
				height: 35px
				border: 5px solid #bbb
				border-radius: 50%
				z-index: 1

</style>