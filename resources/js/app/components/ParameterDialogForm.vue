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
                Add parameter
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5">New parameter</span>
            </v-card-title>
            <v-card-text>
                <div class="d-block mb-4">
                    <small class="grey--text">* field is required</small>
                </div>
                <v-text-field
                    v-model="name"
                    label="Name *"
                    :error-messages="nameErrorMessage"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="coefficient"
                    label="Coefficient (value between 0 and 1) *"
                    type="number"
                    step="0.1"
                    :error-messages="coefficientErrorMessage"
                    required
                ></v-text-field>
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
                    @click="addParameter"
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
            coefficient: 0,

            nameErrorMessage: '',
            coefficientErrorMessage: ''
        }
    },
    methods: {
        addParameter() {
            this.hideErrors()

            this.$emit('parameterCreated', {
                name: this.name,
                coefficient: this.coefficient,
            })
        },

        onParameterSuccessfullyCreated() {
            this.dialog = false

            this.name = ''
            this.coefficient = 0
        },

        onParameterCreatedError(error) {
            console.log(error)
            if (error.response.data.errors) {
                this.showErrors(error.response.data.errors)
            }
        },

        hideErrors () {
            this.nameErrorMessage = ''
            this.coefficientErrorMessage = ''
        },

        showErrors(errors) {
            if (errors.name) {
                this.nameErrorMessage = errors.name
            }

            if (errors.coefficient) {
                this.coefficientErrorMessage = errors.coefficient
            }
        }
    }
}
</script>

<style scoped>

</style>
