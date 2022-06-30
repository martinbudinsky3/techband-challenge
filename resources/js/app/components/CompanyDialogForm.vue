<template>
    <v-dialog
        v-model="dialog"
        max-width="600px"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                class="d-block d-sm-inline-block mt-2 mt-sm-0 responsive-btn"
                color="primary"
                dark
                v-bind="attrs"
                v-on="on"
            >
                Add company
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5">New company</span>
            </v-card-title>
            <v-card-text>
                <v-text-field
                    v-model="name"
                    label="Name *"
                    :error-messages="nameErrorMessage"
                    required
                ></v-text-field>
                <small>* field is required</small>
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
        addCompany() {
            this.$emit('companyCreated', {value: 4, text: this.name})

            this.name = ''
        },

        onCompanySuccessfullyCreated() {
            this.dialog = false

            this.name = ''
        },

        onCompanyCreatedError(error) {
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
