import './bootstrap'
import router from './router'
import App from './App.vue'
import Vue from "vue";
import Vuetify from "vuetify";

Vue.use(Vuetify)

const vuetify = new Vuetify({})

const app = new Vue({
    vuetify: vuetify,
    router,
    render: h => h(App)
}).$mount('#app')
