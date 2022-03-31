import axios from 'axios'
import Vue from 'vue'
import router from './router'

window.axios = axios
window.Vue = Vue

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
window.axios.defaults.headers.common['Accept'] = 'application/json'

window.axios.defaults.withCredentials = true
window.axios.interceptors.response.use((response) => response, (error) => {
    if (
        error.response &&
        (error.response.status === 401 || error.response.status === 419) &&
        router.currentRoute.path !== '/login'
    ) {
        if (!router.currentRoute.path.match('admin*')) {
            router.push({ path: '/admin/login' })
        } else {
            router.push({ path: '/login' })
        }

    } else {
        throw error
    }
})

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error(
        'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token'
    )
}
