<template>
    <div>
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
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {email: this.email, password: this.password})
                    .then(response => {
                        console.log(response)
                        this.$router.push('/')
                    })
                    .catch(error => console.log(error))
            });
        },
    }
}
</script>

<style scoped>

</style>
