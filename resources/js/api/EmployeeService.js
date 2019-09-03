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
    return ApiService.get('employees', filters)
  },
  get(id) {
    return ApiService.get(`employees/${id}`)
  },
  create (data) {
    return ApiService.post('employees', data)
  },
  update (id, data) {
    return ApiService.update(`employees/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`employees/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`employees/${id}`, null, {
        action: 'restore'
    })
  }
}
