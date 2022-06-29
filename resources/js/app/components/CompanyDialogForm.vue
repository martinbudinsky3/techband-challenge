<template>
    <v-dialog
        v-model="dialog"
        max-width="600px"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
                v-bind="attrs"
                v-on="on"
            >
                Pridať spoločnosť
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5">Nová spoločnosť</span>
            </v-card-title>
            <v-card-text>
                <v-text-field
                    v-model="name"
                    label="Názov *"
                    :error-messages="nameErrorMessage"
                    required
                ></v-text-field>
                <small>* pole je povinné</small>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="dialog = false"
                >
                    Close
                </v-btn>
                <v-btn
                    color="blue darken-1"
                    text
                    @click="addCompany"
                >
                    Save
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {
    VBtn,
    VDialog,
    VCard,
    VCardActions,
    VCardText,
    VCardTitle,
    VSpacer,
    VTextField
} from 'vuetify/lib'

export default {
    components: {
        VBtn,
        VDialog,
        VCard,
        VCardActions,
        VCardText,
        VCardTitle,
        VSpacer,
        VTextField
    },
    data() {
        return {
            dialog: false,
            name: '',

            nameErrorMessage: ''
        }
    },
    methods: {
        addCompany(event) {
            this.dialog = false
            this.$emit('companyCreated', {value: 4, text: this.name})

            this.name = ''
        },

        onParameterSuccessfullyCreated() {
            this.dialog = false

            this.name = ''
        },

        onParameterCreatedError(error) {
            console.log(error)
            if (error.response.data.errors) {
                this.showErrors(error.response.data.errors)
            }
        },

        hideErrors () {
            this.nameErrorMessage = ''
        },

        showErrors(errors) {
            if (errors.name) {
                this.nameErrorMessage = errors.name
            }
        }
    }
}
</script>
