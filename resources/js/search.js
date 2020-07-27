import Vue from 'vue'
import Search from './components/user/Search';

new Vue({
    el:'#app',
    render: h => h(Search)
}).$mount('#app')
