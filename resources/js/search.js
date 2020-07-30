import Vue from 'vue'
import Search from './components/user/Search';
import SingleCard from "./components/user/SingleCard";
import axios from "axios";

axios.defaults.baseURL = 'http://helix.test/api/'

new Vue({
    render: h => h(Search)
}).$mount('#app')
