<template>
    <v-app>
        <div>
            <parameter-dialog-form @parameterCreated="onParameterCreated"></parameter-dialog-form>
            <v-data-table
                :headers="headers"
                :items="parameters"
                :hide-default-footer="true"
                class="elevation-1"
            >
<!--                <template v-slot:item="{ item }">-->
<!--                    <tr>-->
<!--                        <td>{{item.parameter}}</td>-->
<!--                        <td>{{item.coefficient }}</td>-->
<!--                        <td><v-icon>mdi-check</v-icon></td>-->
<!--                    </tr>-->
<!--                </template>-->
            </v-data-table>
        </div>
    </v-app>
</template>

<script>
import {
    VDataTable,
    VBtn,
    VApp,
    VIcon
} from 'vuetify/lib'
import ParameterDialogForm from "./components/ParameterDialogForm";

export default {
    components: {
        ParameterDialogForm,
        VDataTable,
        VBtn,
        VApp,
        VIcon
    },
    data() {
        return {
            dialog: false,

            parameters: [
                {
                    id: 1,
                    parameter: 'parameter 1',
                    coefficient: 0.5,
                },
                {
                    id: 2,
                    parameter: 'parameter 2',
                    coefficient: 0.8,
                },
                {
                    id: 3,
                    parameter: 'parameter 3',
                    coefficient: 0.2,
                },
            ],
            hardHeaders: [
                {
                    text: "Parameter",
                    value: "parameter",
                },
                {
                    text: "Coefficient",
                    value: "coefficient",
                }
            ],
            companies: [
                {
                    text: 'company 1',
                    value: '1',
                },
                {
                    text: 'company 2',
                    value: '2',
                },
                {
                    text: 'company 3',
                    value: '3',
                },
            ],
        }
    },
    methods: {
        onParameterCreated(parameter) {
            this.parameters.push(parameter)
        }
    },
    computed: {
        headers: function () {
            // `this` points to the vm instance
            return this.hardHeaders.concat(this.companies)
        }
    }
}
</script>
