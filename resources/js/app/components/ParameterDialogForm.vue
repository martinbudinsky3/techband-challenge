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
                Pridať parameter
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                <span class="text-h5">Nový parameter</span>
            </v-card-title>
            <v-card-text>
                <v-text-field
                    v-model="name"
                    label="Názov *"
                    required
                ></v-text-field>

                <v-text-field
                    v-model="coefficient"
                    label="Koeficient (hodnota medzi 0 a 1) *"
                    type="number"
                    step="0.1"
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
        }
    },
    methods: {
        addParameter(event) {
            this.dialog = false
            this.$emit('parameterCreated', {
                name: this.name,
                coefficient: this.coefficient,
            })

            this.name = ''
            this.coefficient = 0
        }
    }
}
</script>

<style scoped>

</style>
