import './bootstrap'
import router from './router'
import Admin from './Admin.vue'


const admin = new Vue({
    router,
    render: h => h(Admin)
}).$mount('#admin')
