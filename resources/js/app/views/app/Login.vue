<template>
    <div class="mt-6">
        <v-text-field
            v-model="email"
            label="Email"
            type="email"
            required
        ></v-text-field>
        <v-text-field
            v-model="password"
            label="Heslo"
            type="password"
            :error-messages="loginError ? loginErrorMessage : ''"
            required
        ></v-text-field>
        <v-btn color="primary"
               class="mt-2"
               dark @click="login">
            Prihlásiť sa
        </v-btn>
        <div class="mt-4">
            <a class="black--text" href="/register">Registrácia</a>
        </div>
    </div>
</template>

<script>
import {
    VBtn,
    VTextField
} from 'vuetify/lib'

export default {
    components: {
        VBtn,
        VTextField
    },
    data() {
        return {
            email: '',
            password: '',

            loginError: false,
            loginErrorMessage: 'Incorrect credentials'
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', {email: this.email, password: this.password})
                    .then(response => {
                        console.log(response)
                        let user = response.data
                        let route = user.is_admin ? '/admin' : '/'
                        this.$router.push(route)
                    })
                    .catch(error => {
                        if ([401, 422].includes(error.response.status)) {
                            this.loginError = true
                        }
                        console.log(error)
                    })
            });
        },
    }
}
</script>

<style scoped>

</style>
