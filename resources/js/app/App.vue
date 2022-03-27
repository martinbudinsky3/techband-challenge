<template>
    <v-app>
        <div>

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
                            label="Názov *"
                            required
                        ></v-text-field>

                        <v-text-field
                            label="Koeficient *"
                            type="number"
                            step="0.1"
                            required
                        ></v-text-field>
                        <small>*indicates required field</small>
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
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                    <tr>
                        <th class="text-left">
                            Parameter
                        </th>
                        <th class="text-left">
                            Koeficient
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-for="item in parameters"
                        :key="item.name">
                        <td>{{ item.name }}</td>
                        <td>{{ item.coefficient }}</td>
                    </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </div>
    </v-app>
</template>

<script>
import {
    VSimpleTable,
    VBtn,
    VApp,
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
        VSimpleTable,
        VBtn,
        VApp,
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
            parameters: [
                {
                    name: 'parameter 1',
                    coefficient: 0.5,
                },
                {
                    name: 'parameter 2',
                    coefficient: 0.8,
                },
                {
                    name: 'parameter 3',
                    coefficient: 0.2,
                },
            ],
        }
    },
    methods: {
        addParameter(event) {
            this.dialog = false
            this.parameters.push({name: 'Test', coefficient: 1})
        }
    }
}
</script>
