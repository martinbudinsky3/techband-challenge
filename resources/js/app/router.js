// router
import Router from 'vue-router'

// views
import MainPage from './views/MainPage.vue'
//import NotFound from './views/NotFound.vue'

// users
//import Users from './admin/views/users/Users.vue'
//import UserSingle from './admin/views/users/UserDetail.vue'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: MainPage
        },
        // {
        //     path: '/admin/',
        //     component: Dashboard
        // },
        //
        // // POSTS
        // {
        //     path: '/admin/posts',
        //     component: Posts
        // },
        // {
        //     path: '/admin/posts/new',
        //     component: PostCreate
        // },
        // {
        //     path: '/admin/posts/:id',
        //     component: PostSingle
        // },
        // {
        //     path: '/admin/posts/:id/edit',
        //     component: PostEdit
        // },
        //
        // // COMMENTS
        // {
        //     path: '/admin/comments',
        //     component: Comments
        // },
        // {
        //     path: '/admin/comments/:id',
        //     component: CommentSingle
        // },
        //
        // // USERS
        // {
        //     path: '/admin/users',
        //     component: Users
        // },
        // {
        //     path: '/admin/users/:id',
        //     component: UserSingle
        // },
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
