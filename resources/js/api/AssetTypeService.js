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
    return ApiService.get('asset-types', filters)
  },
  get(id) {
    return ApiService.get(`asset-types/${id}`)
  },
  create (data) {
    return ApiService.post('asset-types', data)
  },
  update (id, data) {
    return ApiService.update(`asset-types/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`asset-types/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`asset-types/${id}`, null, {
        action: 'restore'
    })
  }
}
