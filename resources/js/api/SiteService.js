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
  update (data, id) {
    return ApiService.update('sites', id, { page: params })
  },
  destroy (id) {
    return ApiService.delete(`sites/${id}`)
  }
}