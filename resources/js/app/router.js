// router
import Router from 'vue-router'
import Vue from 'vue'

// views
import MainPage from './views/MainPage.vue'
import Login from './views/Login.vue'
import AdminLogin from './views/AdminLogin.vue'

// users
import UserDetail from './views/UserDetail.vue'
import Users from "./views/Users";

//import NotFound from './views/NotFound.vue'


Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: MainPage
        },
        {
            path: '/login/',
            component: Login
        },
        {
            path: '/admin/login',
            component: AdminLogin
        },
        {
            path: '/admin/users',
            component: Users
        },
        {
            path: '/admin/users/:id',
            component: UserDetail
        },
        //
        // // 404
        // {
        //     path: '/admin/404',
        //     component: NotFound
        // },
        // {
        //     path: '*',
        //     redirect: '/admin/404'
        // }
    ]
})
