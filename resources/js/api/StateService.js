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
    return ApiService.get('states', filters)
  },
  get(id) {
    return ApiService.get(`states/${id}`)
  },
  create (data) {
    return ApiService.post('states', data)
  },
  update (id, data) {
    return ApiService.update(`states/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`states/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`states/${id}`, null, {
        action: 'restore'
    })
  }
}
