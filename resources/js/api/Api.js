import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

const ApiService = {
  init () {

    Vue.use(VueAxios, axios)
    
    if ( process.env.NODE_ENV == 'production' )
      Vue.axios.defaults.baseURL = process.env.MIX_PROD_API_URL + '/'
    else
      Vue.axios.defaults.baseURL = process.env.MIX_API_URL + '/'
    
    Vue.axios.defaults.headers.common['Accept'] = 'application/json'
    Vue.axios.defaults.headers.common['Content-Type'] = 'application/jsoncharset=UTF-8'
    Vue.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
      Vue.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
      console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
    }

  },

  query (resource, params = null) {
    return Vue.axios.get(resource, { params: params })
  },

  get (resource, params = null) {
    return Vue.axios.get(resource, { params: params })
  },

  download (resource) {
    return Vue.axios.get(resource, { responseType: 'blob'}).catch((error) => {
      return new Promise((resolve, reject) => {
        var fileReader = new FileReader()

        fileReader.onload = () => {
          error.response.data = JSON.parse(fileReader.result)
          reject(error)
        }

        fileReader.onerror = () => {
          reject(fileReader.error)
        }

        fileReader.readAsText(error.response.data)
      })

    })
  },

  post (resource, data, params = null) {
    return Vue.axios.post(resource, data, { params: params })
  },

  upload (resource, files, onProgress) {
    return Vue.axios.post(resource, files, {
      headers: { 'Content-Type': 'multipart/form-data' },
      onUploadProgress: function( progressEvent ) {
        const progress = parseInt( Math.round( ( progressEvent.loaded * 100 ) / progressEvent.total ) )
        onProgress(progress)
      }
    })
  },

  update (resource, data, params = null) {
    return Vue.axios.put(resource, data, { params: params })
  },

  put (resource, data, params = null) {
    return Vue.axios.put(resource, data, { params: params })
  },

  delete (resource, data, params = null) {
    return Vue.axios.delete(resource, { params: params })
  }
}

export default ApiService
