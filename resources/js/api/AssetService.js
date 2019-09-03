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
    return ApiService.get('assets', filters)
  },
  get(id) {
    return ApiService.get(`assets/${id}`)
  },
  create (data) {
    return ApiService.post('assets', data)
  },
  update (id, data) {
    return ApiService.update(`assets/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`assets/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`assets/${id}`, null, {
        action: 'restore'
    })
  }
}
