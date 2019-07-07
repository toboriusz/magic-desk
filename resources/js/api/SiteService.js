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
    return ApiService.get('sites', filters)
  },
  get(id) {
    return ApiService.get(`sites/${id}`)
  },
  create (data) {
    return ApiService.post('sites', data)
  },
  update (id, data) {
    return ApiService.update(`sites/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`sites/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`sites/${id}`, null, {
        action: 'restore'
    })
  }
}
