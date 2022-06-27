// router
import Router from 'vue-router'
import Vue from 'vue'

// views
import MainPage from './views/app/MainPage.vue'
import Login from './views/app/Login.vue'
import AdminLogin from './views/admin/AdminLogin.vue'

// users
import UserDetail from './views/admin/UserDetail.vue'
import Users from "./views/admin/Users";
import AdminApp from "./layouts/AdminApp";
import ClientApp from "./layouts/ClientApp";

//import NotFound from './views/NotFound.vue'


Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/admin',
            component: AdminApp,
            children: [
                {
                    path: 'login',
                    component: AdminLogin
                },
                {
                    path: '',
                    redirect: 'users'
                },
                {
                    path: 'users',
                    component: Users
                },
                {
                    path: 'users/:id',
                    component: UserDetail
                },
            ]
        },
        {
            path: '/',
            component: ClientApp,
            children: [
                {
                    path: '',
                    component: MainPage
                },
                {
                    path: 'login',
                    component: Login
                },
            ]
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
