const toggleFullScreen = () => {
  let doc = window.document
  let docEl = doc.documentElement

  let requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen
  let cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen

  if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
    requestFullScreen.call(docEl)
  }
  else {
    cancelFullScreen.call(doc)
  }
}

const validateErrors = (e, component, scope = null) => {
  if(e.response.status === 422 && e.response.data.data) {
    const errors = e.response.data.data.validation_errors || []
    for(let key in errors) {
      component.$validator.errors.add({
        field: key, 
        msg: errors[key].join(' '),
        scope: scope 
      })
    }
  }
}

export default {
	toggleFullScreen,
  validateErrors
}