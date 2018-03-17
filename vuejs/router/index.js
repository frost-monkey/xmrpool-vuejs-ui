import "babel-polyfill"
import Vue from 'vue'
import Router from 'vue-router'
import routes from './routes'

// Router
Vue.use(Router)

export default new Router({
    mode: 'history',
    //linkActiveClass: 'active',
    //history: true,
    routes
})