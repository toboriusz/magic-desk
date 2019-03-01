import ApiService from 'Api/Api'
//Example
export default {
  verifyEmail (token) {
    return ApiService.post('auth/verify-email', {
      token: token
    })
  },
  sendResetEmail (email) {
    return ApiService.post('auth/password-reset/send', {
      email: email
    })
  },
  resetPassword (password, password_confirmation, token) {
    return ApiService.post('auth/password-reset/update', {
      password: password,
      password_confirmation: password_confirmation,
      token: token
    })
  }
}