import axios from 'axios'
import Vue from 'vue'

window.axios = axios
window.Vue = Vue

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

let apiToken = document.head.querySelector('meta[name="api-token"]')
if (apiToken) {
    window.axios.defaults.headers.common['Authorization'] =
        'Bearer ' + apiToken.content
}

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
