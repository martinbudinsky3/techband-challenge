<template>
    <div class="mt-6">
        <h1 class="mb-6 text-center">Registration</h1>
        <div class="d-block mb-4">
            <small class="grey--text">* field is required</small>
        </div>

        <v-form
            @submit.prevent="register"
            lazy-validation>
            <v-text-field
                v-model="name"
                label="Name *"
                type="text"
                :error-messages="nameErrorMessage"
                required
            ></v-text-field>
            <v-text-field
                v-model="email"
                label="Email *"
                type="email"
                :error-messages="emailErrorMessage"
                required
            ></v-text-field>
            <v-text-field
                v-model="password"
                label="Password *"
                type="password"
                :error-messages="passwordErrorMessage"
                required
            ></v-text-field>
            <v-text-field
                v-model="passwordConfirmation"
                label="Password confirmation *"
                type="password"
                required
            ></v-text-field>
            <v-btn color="primary"
                   type="submit"
                   dark>
                Registrovať sa
            </v-btn>
        </v-form>
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
            name: '',
            email: '',
            password: '',
            passwordConfirmation: '',

            nameErrorMessage: '',
            emailErrorMessage: '',
            passwordErrorMessage: ''
        }
    },
    methods: {
        register() {
            this.hideErrors()

            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation
                })
                    .then(response => {
                        console.log(response)
                        let user = response.data
                        let route = user.is_admin ? '/admin' : '/'
                        this.$router.push(route)
                    })
                    .catch(error => {
                        if (error.response.data.errors) {
                            this.showErrors(error.response.data.errors)
                        }

                        console.log(error)
                    })
            });
        },

        hideErrors () {
            this.nameErrorMessage = ''
            this.emailErrorMessage = ''
            this.passwordErrorMessage = ''
        },

        showErrors(errors) {
            if (errors.name) {
                this.nameErrorMessage = errors.name
            }

            if (errors.email) {
                this.emailErrorMessage = errors.email
            }

            if (errors.password) {
                this.passwordErrorMessage = errors.password
            }
        }
    }
}
</script>

<style scoped>

</style>
