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
        router.push({ path: '/login' })
    } else {
        throw error
    }
})
