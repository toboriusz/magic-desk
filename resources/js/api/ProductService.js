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
    return ApiService.get('products', filters)
  },
  get(id) {
    return ApiService.get(`products/${id}`)
  },
  create (data) {
    return ApiService.post('products', data)
  },
  update (id, data) {
    return ApiService.update(`products/${id}`, data)
  },
  delete (id, permanently = false) {
    return ApiService.delete(`products/${id}`, null, {
        permanently: permanently
    })
  },
  restore (id) {
    return ApiService.update(`products/${id}`, null, {
        action: 'restore'
    })
  }
}
