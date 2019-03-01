import AuthService from 'Api/AuthService'

const state = {
	//States
}

const getters = {
	//Getters
}

const actions = {
	verifyEmail (context, data) {
		return AuthService.verifyEmail(data.token)
	},
	sendResetEmail (context, data) {
		return AuthService.sendResetEmail(data.email)
	},
	resetPassword (context, data) {
		return AuthService.resetPassword(data.password, data.password_confirmation, data.token)
	}
}

const mutations = {
	//Mutations
}

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}