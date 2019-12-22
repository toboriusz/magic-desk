import ApiService from 'Api/Api'
//Example
export default {
  query (type, params) {
    return ApiService
      .query(
        'articles' + (type === 'feed' ? '/feed' : ''),
        { params: params }
      )
  },
  getList(filters = null) {
    return ApiService.get('users', filters)
  },
  get(id) {
    return ApiService.get(`users/${id}`)
  },
  create (data) {
    return ApiService.post('users', data)
  },
  update (id, data) {
    return ApiService.update(`users/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`users/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`users/${id}`, null, {
        action: 'restore'
    })
  }
}
