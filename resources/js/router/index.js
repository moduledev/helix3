import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Signin from "../views/Signin"
import Dashboard from "../views/Dashboard"
import store from './../store'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/signin',
        name: 'signin',
        component: Signin,
        beforeEnter: (to, from, next) => {
            if (store.getters['auth/getAuthenteticated']) {
                return next({
                    name: 'dashboard'
                })
            }
            next()
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        beforeEnter: (to, from, next) => {
            if (!store.getters['auth/getAuthenteticated']) {
                return next({
                    name: 'signin'
                })
            }
            next()
        }
    },
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router
