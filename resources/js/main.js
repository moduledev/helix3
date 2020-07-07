import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

require('./store/subscriber')

axios.defaults.baseURL = 'http://helix.test/api/'

Vue.config.productionTip = false

store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
  new Vue({
    el:'#app',
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
})

