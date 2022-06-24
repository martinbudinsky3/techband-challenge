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
            required
        ></v-text-field>
        <v-btn color="primary"
               dark @click="login">
            Prihlásiť sa
        </v-btn>
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
        }
    },
    methods: {
        login() {
            console.log("Admin logging in")
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/admin/login', {email: this.email, password: this.password})
                    .then(response => {
                        console.log(response)
                        this.$router.push('/admin/users')
                    })
                    .catch(error => console.log(error)) // TODO show error message
            });
        },
    }
}
</script>

<style scoped>

</style>
