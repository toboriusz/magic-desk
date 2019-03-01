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
  get (pageId = '') {
    return ApiService.get(`pages/${pageId}`)
  },
  create (data) {
    return ApiService.post('pages', data)
  },
  update (pageId, params) {
    return ApiService.update('pages', pageId, {page: params})
  },
  destroy (pageId) {
    return ApiService.delete(`pages/${pageId}`)
  }
}